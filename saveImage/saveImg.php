<?php

function saveImage(array $payload2):bool{

    $fileName=$payload2['--output-file'];
    $resource=$payload2['--image'];
    return $resource->writeImage($fileName);

}