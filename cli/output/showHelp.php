<?php

function showHelp(){
    var_dump("lalala");
    $message = fopen("/home/dorottyarakhelboros/Dori/photoModifyApp/output/helpMessage.txt", "r");
    echo fread($message,filesize("/home/dorottyarakhelboros/Dori/photoModifyApp/output/helpMessage.txt"));
    fclose($message);
}
