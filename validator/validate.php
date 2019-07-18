<?php

// validate the command

function validateCommand(array $payload):array{
    $errors=[];

    if(!validatePath($payload['--input-file'])) $errors['--input-file-path']="The path for the input file or the input file is invalid.";

    if(!verifyOutputFilePath($payload['--output-file'])) $errors['wrong-output-file-path']="The path for the output file is invalid.";

    if(isset($payload['--watermark']) && !validatePath($payload['--watermark'])) $errors['watermark-path']="The path for the watermark is invalid.";

    if(!validateExtension($payload['--input-file'])) $errors['wrong-format']="The image extension is not supported. Try png, jpg or jpeg.";

    if(isset($payload['--output-file']) && !validateExtension($payload['--output-file'])) $errors['wrong-format']="The image extension is not supported. Try png, jpg or jpeg.";

    if(isset($payload['watermark']) && !validateExtension($payload['--watermark'])) $errors['wrong-image-format']="The image extension is not supported. Try png, jpg or jpeg.";

    if(isset($payload['--width']) && !validatePixelValue($payload['--width'])) $errors['wrong-width']="Width value is not valid.";

    if(isset($payload['--height']) && !validatePixelValue($payload['--height'])) $errors['wrong-height']="Height value is not valid.";

    if(isset($payload['--format']) && !validateRatioFormat($payload['--format'])) $errors['wrong-format']="Wrong ratio format. Must be like x:y, with x and y integers.";

    if(!hasValidCommands($payload)) $errors['invalid-command']="Wrong command specified. Please check --help and try again.";

    if(!hasMandatoryCommands($payload)) $errors['mandatory-command']="You must specify input-file and output-file commands.";

    return $errors;
}

// validation functions

function validatePath(string $path):bool {
    if(file_exists($path)) return true;
    else return false;
}

function hasMandatoryCommands(array $commands):bool {

    $mandatoryCommands=[
        "--input-file",
        "--output-file",
    ];

    foreach ($commands as $key=>$command){

        if(!in_array(trim($key),$mandatoryCommands)) {
            return false;
        }
    }
    return true;

}

function verifyOutputFilePath($path){
    $pos=strrpos($path,"/");
    if($pos){
        $dirPath=substr($path,0,$pos-1);
        if(!is_dir($dirPath)) return true;
        return false;
    }
    return true;
}

function hasValidCommands(array $commands):bool{

    $validCommandsList=[
        "--input-file",
        "--output-file",
        "--watermark",
        "--width",
        "--height",
        "--format",
        "--help",
    ];

    foreach ($commands as $key=>$command){
        if(!in_array($key,$validCommandsList)) {
            return false;
        }
    }
    return true;

}

function validatePixelValue(string $dimension):bool{
    if(is_numeric($dimension)) return true;
    return false;
}

function validateRatioFormat(string $format):bool {
    if(preg_match("(\d:\d)",$format)) return true;
    return false;
}

function validateExtension(string $path):bool{
    if(preg_match("/\.(png|jpeg|jpg)$/",$path)==1) return true;
    return false;
}


