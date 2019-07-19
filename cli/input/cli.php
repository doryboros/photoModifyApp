<?php

function readCommand(array $argv):array{
    unset($argv[0]);
    return $argv;
}

function insertArgsInPayload(array $arguments, array $payload):array{

    foreach ($arguments as $argument){

        $argument=explode("=",$argument);
        $key=$argument[0];

        if($key=='--help'){
            $value="";
        }else {
            $value="";
            if(count($argument)==2) $value=$argument[1];
        }

        $payload[$key]=$value;
    }

    return $payload;
}
