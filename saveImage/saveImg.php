<?php

function saveImage(array $payload2){
    $fileName=$payload2['output-file'];
    $resource=$payload2['image'];
    $resource->writeImage($fileName);
}