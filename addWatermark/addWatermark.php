<?php

function canExecuteWatermark(array $payload2){
    if(!isset($payload2['--watermark'])){
        return $payload2;
    }

        return executeWatermark($payload2);
}

function randomCorner($image,$watermark){

    /** @var \Imagick $resource
     */
    $widthImage=$image->getImageWidth();
    $heightImage=$image->getImageHeight();
    $widthWatermark=$watermark->getImageWidth();
    $heightWatermark=$watermark->getImageHeight();

    $corners=[
        [0,0,],
        [$widthImage-$widthWatermark,0],
        [0,$heightImage-$heightWatermark],
        [$widthImage-$widthWatermark,$heightImage-$heightWatermark],
    ];

    return $corners[rand(0,3)];

}

function executeWatermark(array $payload2):array{

    /** @var \Imagick $resource
     */
    $resource=$payload2['--image'];

    $watermark = new Imagick();
    $watermark->readImage($payload2['--watermark']);
    $watermark->scaleImage(($resource->getImageWidth())/10,0);

    $corner=randomCorner($resource,$watermark);
    $resource->compositeImage($watermark, imagick::COMPOSITE_OVER, $corner[0], $corner[1]);

    $payload2['--image']=$resource;

    return $payload2;
}