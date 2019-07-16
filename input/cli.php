<?php

function readCommand(array $argv):array{
    return $argv;
}

function insertArgsInPayload(array $args,array $payload):array{
    $payload=[
        "input-file"=>"",
        "output-file"=>"",
        "width"=>"",
        "height"=>"",
        "format"=>"",
        "watermark"=>"",
        "help"=>""];
    foreach ($args as $arg){
        preg_match("/(?<key>\w+-?\w+)=(?<value>[\w\/\.]*)/",$arg,$matches);
        $payload[$matches[key]]=$matches[value];
    }
    return $payload;
}
