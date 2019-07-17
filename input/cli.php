<?php

function readCommand(array $argv):array{
    unset($argv[0]);
    return $argv;
}

function insertArgsInPayload(array $args, array $payload):array{

    foreach ($args as $argument){

        $argument=explode("=",$argument);
        $key=str_replace("--","",$argument[0]);

        if($key=='help'){
            $value="";
        }else {
            $value=$argument[1];
        }

        $payload[$key]=$value;
    }

    return $payload;
}
