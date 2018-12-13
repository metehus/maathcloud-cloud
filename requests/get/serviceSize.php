<?php

$json = json_decode(file_get_contents('php://input'));

function dirSize($directory) {
    $size = 0;
    foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory)) as $file){
        $size+=$file->getSize();
    }
    return $size;
} 


if(isset($json->service_folder)){
    $dir = "./cloud/services/".$json->service_folder;


$data = ['size' => dirSize($dir)];    



} else {
    $data = errorMessage(801);
}