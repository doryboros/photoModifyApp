<?php

function createHashForDirName(string $userName){
    return md5($userName);
}

function createDirectory(string $dirName){
    mkdir("./uploads/".$dirName);
}
