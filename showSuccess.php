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
    </head>

    <body>
        <h1>Saved form data</h1>

        <div>
            Image title: <?php echo $formData['imageTitle'];?>
        </div>

        <div>
            Image description: <?php echo $formData['imageDescription'];?>
        </div>

        <div>
            Artist name: <?php echo $formData['artistName'];?>
        </div>

        <div>
            Artist email: <?php echo $formData['artistEmail'];?>
        </div>

        <div>
            Camera specifications: <?php echo $formData['cameraSpecs'];?>
        </div>

        <div>
            Price: <?php echo $formData['price'];?>
        </div>

        <div>
            Capture date: <?php echo $formData['captureDate'];?>
        </div>

        <div>
            Tags:
            <?php
                foreach ($formData['tags'] as $item)
                    echo $item." ";
             ?>
        </div>

        <div>
            Image: </br>
            <img src="<?php echo $imagePath;?>" width="150" height="150">
        </div>


    </body>

</html>
