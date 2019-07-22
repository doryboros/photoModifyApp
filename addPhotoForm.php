<?php

session_start();

include "functions.php";

const UPLOAD_PATH="/var/www/my-application/uploads/";

//ini_set("display_errors","on");

    // process form data

    if (isset($_POST['submit'])){

        $errors=[];

        $imageTitle=addslashes($_POST['imageTitle']);
        $imageDescription=addslashes($_POST['imageDescription']);
        $artistEmail=addslashes($_POST['artistEmail']);
        $artistName=$_POST['artistName'];
        $cameraSpecs=addslashes($_POST['cameraSpecs']);
        $price=addslashes($_POST['price']);
        $captureDate=addslashes($_POST['captureDate']);


        if(isset($_POST['tags'])){

            $tags=$_POST['tags'];

            $validTags = ["nature", "animal", "urban"];

            foreach ($tags as $item) {
                if (!in_array($item, $validTags)) {
                    $errors[] = "The tag is not allowed, please choose one from the list.";
                }
            }

        }else{
            $errors[] ='Please select at least one tag.';
        }

        if(empty($imageTitle)){
            $errors[] = 'Please enter the image title.';
        }

        if(empty($imageDescription)){
            $errors[] = 'Please enter the image description.';
        }

        if(empty($artistName)){
            $errors[] = 'Please enter your name.';
        }

        if(empty($artistEmail)){
            $errors[] = 'Please enter your email.';
        }

        if(empty($cameraSpecs)){
            $errors[] = 'Please enter the camera specifications.';
        }

        if(empty($price)){
            $errors[] = 'Please enter the price.';
        }

        $price=(float)$price;

        if(!is_float($price)){
            $errors[] = 'Please enter a valid price.';
        }

        if(empty($captureDate)){
            $errors[] = 'Please enter the capture date.';
        }

        if (!filter_var($artistEmail, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Incorrect email address.';
        }

        if($_FILES['image']['name']==""){
            $errors[] = 'Please select a file.';
        }

        if($_FILES['image']['name']) {

            $fileName = $_FILES['image']['name'];
            $fileType = $_FILES['image']['type'];
            $fileExtension = strtolower(end(explode('.', $fileName)));

            $extensions = ["jpeg", "jpg", "png"];

            if (in_array($fileExtension, $extensions) === false) {
                $errors[] = "Extension of the file is not allowed, please choose a JPG, JPEG or PNG file.";
            }
        }

        // save form data

        if(empty($errors)){

            $fileName = $_FILES['image']['name'];
            $fileTmp = $_FILES['image']['tmp_name'];

            // get the image name without the extension

            $imageNameAndExtension=explode(".",$fileName);
            $imageName=$imageNameAndExtension[0];

            $dirHash=createHashForDirName($artistName);

            if(!file_exists("./uploads/".$dirHash)){
                createDirectory($dirHash);
            }

            // send parameters to the success page

            $_SESSION['filePath']=UPLOAD_PATH.$dirHash;
            $_SESSION['imageName']=$fileName;
            $_SESSION['jsonFileName']=$imageName;

            // save json data

            $jsonFormData=json_encode($_POST);
            file_put_contents("./uploads/".$dirHash."/".$imageName.".json",$jsonFormData);

            // save the image from tmp

            if(move_uploaded_file($fileTmp, UPLOAD_PATH.$dirHash."/".$fileName)){
                header('Location: showSuccess.php');
            }
        }

    }

?>

<!DOCTYPE html>

<html>

    <head>

        <title>Upload photo</title>

        <style>
            label{
                font-weight: bold;
                padding: 10px;
            }
            input, select, textarea{
                margin: 10px;
            }
        </style>

    </head>

    <body>

        <h1>Upload your work</h1>

        <?php if (isset($_POST) && isset($errors)) {?>
            <div style="color: red"><?php echo implode('</br>', $errors); ?></div>
        <?php } ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <fieldset>
                <legend>Upload photo:</legend>

                <label for="imageTitle">Image title</label></br>
                <input type="text" name="imageTitle" id="imageTitle"></br>

                <label for="imageDescription">Image description</label></br>
                <textarea name="imageDescription" id="imageDescription" rows="3" cols="20"></textarea></br>

                <label for="artistEmail">Artist email</label></br>
                <input type="email" name="artistEmail" id="artistEmail"></br>

                <label for="artistName">Artist name</label></br>
                <input type="text" name="artistName" id="artistName"></br>

                <label for="cameraSpecs">Camera specifications</label></br>
                <input type="text" name="cameraSpecs" id="cameraSpecs"></br>

                <label for="price">Price</label></br>
                <input type="number" name="price" id="price" step="0.01" min="0"></br>

                <label for="captureDate">Capture date</label></br>
                <input type="date" name="captureDate" id="captureDate"></br>

                <label for="tags">Tags</label></br>
                <select id="tags" name="tags[]" multiple="multiple">
                    <option value="nature">Nature</option>
                    <option value="animal">Animal</option>
                    <option value="urban">Urban</option>
                </select></br>

                <label for="image">Select a file</label></br>
                <input type="file" name="image" id="image"/><br>

                <input type="submit" name="submit" value="Submit">
                <input type="reset" value="Reset">

            </fieldset>


        </form>

    </body>

</html>