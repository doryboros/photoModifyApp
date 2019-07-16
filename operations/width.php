<?php

function canExecuteWidth(array $payload2,$image){
    if(!isset($payload2['width'])){
        return $payload2;
    }
    else{
        executeWidth($image,$payload2["width"]);
    }
}

function executeWidth($image,$widthValue){

    $image->thumbnailImage(castType($widthValue),$image->getImageHeight);
}

function castType($width){
    return (int)$width;
}