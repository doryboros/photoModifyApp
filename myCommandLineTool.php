<?php

include "input/cli.php";
include "loadImage/readImg.php";
include "operations/width.php";
include "operations/height.php";
include "operations/format.php";
include "saveImage/saveImg.php";


$arguments=readCommand($argv);

$payload1=[];
$payload1 = insertArgsInPayload($arguments,$payload1);

$payload2 = readImage($payload1);

$payload3=canExecuteFormat($payload2);


$payload4=saveImage($payload3);


//var_dump($payload2);