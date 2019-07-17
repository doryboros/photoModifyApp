<?php

include "input/cli.php";
include "loadImage/readImg.php";
include "operations/width.php";
include "saveImage/saveImg.php";

var_dump($argc);
$arguments=readCommand($argv);

$payload1=[];
$payload1 = insertArgsInPayload($arguments,$payload1);

$payload2 = readImage($payload1);


$payload3=canExecuteWidth($payload2,$payload2['image']);
saveImage($payload3);


//var_dump($payload2);