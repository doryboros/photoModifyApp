<?php

function readImage(array $payload1){

    $fileName=$payload1['input-file'];

    $resource= new Imagick($fileName);

    $payload1['image']=$resource;

    return $payload1;

}
