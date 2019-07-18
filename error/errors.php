<?php

include "validator/validate.php";

function getErrors(array $payload){
    $errors=validateCommand($payload);
    return $errors;
}
