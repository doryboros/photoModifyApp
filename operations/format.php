<?php

function canExecuteFormat(array $payload2){
    if(!isset($payload2['format'])){
        return $payload2;
    }
        return executeFormat($payload2);
}

function executeFormat(array $payload2):array{

    /** @var \Imagick $resource
     */
    $resource=$payload2['image'];
    $formats=explode(":",$payload2['format']);
    $format1=$formats[0];
    $format2=$formats[1];
    if(isset($payload2['width'])){

        $newHeight=getNewDimension($payload2['width'],$format1,$format2);
        $resource->scaleImage(castFormat($payload2['width']),$newHeight);

    }
    elseif (isset($payload2['height'])){

        $newWidth=getNewDimension($payload2['height'],$format1,$format2);
        $resource->scaleImage($newWidth,castFormat($payload2['height']));

    }else{

        $width=$resource->getImageWidth();
        $newHeight=getNewDimension($width,$format1,$format2);
        $resource->scaleImage($width,$newHeight);
    }

    $payload2['image']=$resource;

    return $payload2;
}

function castFormat($format):int{
    return (int)$format;
}

function getNewDimension(int $dimension, int $format1, int $format2):int{
    return ($dimension*$format2)/$format1;
}