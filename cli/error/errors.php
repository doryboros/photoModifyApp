<?php

require __DIR__ . "/../validator/validate.php";

function getErrors(array $payload){
    $errors=validateCommand($payload);
    return $errors;
}
