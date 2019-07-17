<?php

function existsHelp(array $payload2):boolean{
    if(isset($payload2['help'])){
        return true;
    }
    return false;
}