<?php

function showHelp(){
    $message = fopen("/home/dorottyarakhelboros/Dori/photoModifyApp/output/helpMessage.txt", "r") or die("Unable to open file!");
    echo fread($message,filesize("/home/dorottyarakhelboros/Dori/photoModifyApp/output/helpMessage.txt"));
    fclose($message);
}
