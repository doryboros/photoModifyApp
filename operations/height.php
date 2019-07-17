<?php

function canExecuteHeight(array $payload2){
    if(!isset($payload2['height'])){
        return $payload2;
    }

        return executeHeight($payload2);
}

function executeHeight(array $payload2):array{

    /** @var \Imagick $resource
     */
    $resource=$payload2['image'];
    $resource->scaleImage(0,castHeight($payload2['height']));
    $payload2['image']=$resource;

    return $payload2;
}

function castHeight($height){
    return (int)$height;
}
