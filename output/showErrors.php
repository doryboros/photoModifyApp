<?php

include "error/errors.php";

function showErrors($errors){

    foreach ($errors as $error) print $error.PHP_EOL;

}