<?php

include  "input/cli.php";

$arguments=readCommand($argv);
$payload=[];
$payload = insertArgsInPayload($arguments,$payload);
var_dump($payload);