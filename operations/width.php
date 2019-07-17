<?php

function canExecuteWidth(array $payload2,$image){
    if(!isset($payload2['width'])){
        return $payload2;
    }
    else{
        executeWidth($image,$payload2["width"]);
    }
}

function executeWidth($payload2,int $widthValue){

    $payload2['image']->adaptiveResizeImage(castType($widthValue),$image->getImageHeight);
    return $payload2;
}

function castType($width){
    return (int)$width;
}