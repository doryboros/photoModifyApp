<?php

include "input/cli.php";
include "loadImage/readImg.php";
include "operations/width.php";
include "operations/height.php";
include "operations/format.php";
include "addWatermark/addWatermark.php";
include "isHelp/isHelp.php";
include "output/showHelp.php";
include "saveImage/saveImg.php";

$arguments=readCommand($argv);


$payload1=[];
$payload1 = insertArgsInPayload($arguments,$payload1);

if(existsHelp($payload1)){
    showHelp();
    exit;
}

$payload2 = readImage($payload1);

$payload3=canExecuteWidth($payload2);
$payload3=canExecuteHeight($payload2);
$payload3=canExecuteFormat($payload2);
$payload3=canExecuteWatermark($payload2);


$payload4=saveImage($payload3);
