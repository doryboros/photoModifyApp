<?php

function canExecuteWidth(array $payload2){
    if(!isset($payload2['width']) || isset($payload2['format'])){
        return $payload2;
    }
    else{
        return executeWidth($payload2);
    }
}

function executeWidth(array $payload2):array{

    /** @var \Imagick $resource
    */
    $resource=$payload2['image'];
    $resource->scaleImage(castWidth($payload2['width']),0);
    $payload2['image']=$resource;

    return $payload2;
}

function castWidth($width){
    return (int)$width;
}