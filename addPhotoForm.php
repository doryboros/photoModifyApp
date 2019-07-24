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

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link type="text/css" rel="stylesheet" href="assets/style.css">

    </head>

    <body>

        <?php if (isset($_POST) && isset($errors)) {?>
            <div style="color: red"><?php echo implode('</br>', $errors); ?></div>
        <?php } ?>

        <div class="container">

            <h1 class="jumbotron">Upload your work</h1>

            <form action="" method="POST" enctype="multipart/form-data">


                <div class="form-group">
                    <label for="imageTitle" class="well well-sm">Image title</label>
                    <input type="text" name="imageTitle" id="imageTitle" class="form-control">
                </div>

                <div class="form-group">
                    <label for="imageDescription" class="well well-sm">Image description</label>
                    <textarea name="imageDescription" id="imageDescription" rows="3" cols="20" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="artistEmail" class="well well-sm">Artist email</label>
                    <input type="email" name="artistEmail" id="artistEmail" class="form-control">
                </div>

                <div class="form-group">
                    <label for="artistName" class="well well-sm">Artist name</label>
                    <input type="text" name="artistName" id="artistName" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cameraSpecs" class="well well-sm">Camera specifications</label>
                    <input type="text" name="cameraSpecs" id="cameraSpecs" class="form-control">
                </div>

                <div class="form-group">
                    <label for="price" class="well well-sm">Price</label>
                    <input type="number" name="price" id="price" step="0.01" min="0" class="form-control">
                </div>

                <div class="form-group">
                    <label for="captureDate" class="well well-sm">Capture date</label>
                    <input type="date" name="captureDate" id="captureDate" class="form-control">
                </div>

                <div class="form-group">
                    <label for="tags" class="well well-sm">Tags</label>
                    <select id="tags" name="tags[]" multiple="multiple" class="form-control">
                        <option value="nature">Nature</option>
                        <option value="animal">Animal</option>
                        <option value="urban">Urban</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image" class="well well-sm">Select a file</label>
                    <input type="file" name="image" id="image"class="custom-file-label">
                </div>

                <input type="submit" name="submit" value="Submit" class="btn btn-default">
                <input type="reset" value="Reset" class="btn btn-default">

            </form>

        </div></br>

    </body>

</html>