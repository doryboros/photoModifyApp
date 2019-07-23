<?php

session_start();

$jsonFileName=$_SESSION['jsonFileName'].'.json';
$jsonFilePath=$_SESSION['filePath'];
$imageName=$_SESSION['imageName'];

// create image path

$imagePath=str_replace("/var/www/my-application/","",$jsonFilePath)."/".$imageName;

// read and decode saved json file

$jsonFileContent=file_get_contents($jsonFilePath."/".$jsonFileName);
$formData=json_decode($jsonFileContent,true);

?>

<html>

    <head>
        <title>Form data</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>

    <body>

        <div class="container">

            <h1 class="jumbotron">We received the following data</h1>

            <div class="well well-sm">
                Image title: <?php echo $formData['imageTitle'];?>
            </div>

            <div class="well well-sm">
                Image description: <?php echo $formData['imageDescription'];?>
            </div>

            <div class="well well-sm">
                Artist name: <?php echo $formData['artistName'];?>
            </div class="well well-sm">

            <div class="well well-sm">
                Artist email: <?php echo $formData['artistEmail'];?>
            </div>

            <div class="well well-sm">
                Camera specifications: <?php echo $formData['cameraSpecs'];?>
            </div>

            <div class="well well-sm">
                Price: <?php echo $formData['price'];?>
            </div>

            <div class="well well-sm">
                Capture date: <?php echo $formData['captureDate'];?>
            </div>

            <div class="well well-sm">
                Tags:
                <?php
                foreach ($formData['tags'] as $item)
                    echo $item." ";
                ?>
            </div>

            <div class="text-center">
                Image: </br>
                <img src="<?php echo $imagePath;?>" class="img-thumbnail" width="200" height="200">
            </div>

        </div>

    </body>

</html>
