<?php

function validateCommand($payload){
    $errors=[];
    if(!validatePath($payload['input-file'])) $errors['input-file']="The path for the input file or the input file is invalid.";
    if(!validatePath($payload['output-file'])) $errors['output-file']="The path for the output file is invalid.";
    if(isset($payload['width'])) $errors;
    if(isset($payload['format']) && !validateRatioFormat($payload['format'])) $errors['format']="Wrong ratio format. Must be like x:y.";
}

function validatePath($path):boolean{
    if(file_exists($path)) return true;
    else return false;
}

function validCommands($commands){
    $validCommands=[
        "--input-file",
        "--output-file",
        "--width",
        "--height",
        "--format",
        "--help",
    ];

}

function validatePixelValue($dimension):boolean{
    $format=explode("=",$dimension);
    if(preg_match("(\d:\d)",$format[1])) return true;
    else return false;
}

function validateRatioFormat($ratio){

}

function validateExtension(){

}

