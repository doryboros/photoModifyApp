<?php

ini_set("display_errors", "on");

require __DIR__ . "/input/cli.php";
require __DIR__ . "/loadImage/readImg.php";
require __DIR__ . "/operations/width.php";
require __DIR__ . "/operations/height.php";
require __DIR__ . "/operations/format.php";
require __DIR__ . "/addWatermark/addWatermark.php";
require __DIR__ . "/isHelp/isHelp.php";
require __DIR__ . "/output/showHelp.php";
require __DIR__ . "/output/showErrors.php";
require __DIR__ . "/saveImage/saveImg.php";
require __DIR__ . "/output/showSuccess.php";
require __DIR__ . "/error/errors.php";

$arguments=readCommand($argv);

$payload1=[];
$payload1 = insertArgsInPayload($arguments,$payload1);

if(existsHelp($payload1)){
    showHelp();
    exit;
}

$errors=getErrors($payload1);
if(!empty($errors)){
    showErrors($errors);
    exit;
}

$payload2 = readImage($payload1);

$payload3=canExecuteWidth($payload2);
$payload3=canExecuteHeight($payload2);
$payload3=canExecuteFormat($payload2);
$payload3=canExecuteWatermark($payload2);


$payload4=saveImage($payload3);

if($payload4) showSuccess();