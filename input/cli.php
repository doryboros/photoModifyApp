<?php

function readCommand(array $argv):array{
    unset($argv[0]);
    return $argv;
}

function insertArgsInPayload(array $args, array $payload = []):array{

    foreach ($args as $argument){
//      preg_match("/(?<key>\w+-?\w+)=(?<value>[\w\/\.]*)/",$argument,$matches);
//      $payload[$matches['key']]=$matches['value'];

        $argument=explode("=",$argument);
        $key=str_replace("--","",$argument[0]);
        $value=$argument[1];
        $payload[$key]=$value;
        var_dump($payload);

    }
    return $payload;
}
