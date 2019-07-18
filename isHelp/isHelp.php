<?php

/**
 * @param array $payload2
 * @return bool
 */

function existsHelp(array $payload2):bool{
    if(isset($payload2['--help'])){
        return true;
    }
    return false;
}