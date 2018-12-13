<?php

include "./resources/uuid.php";

$myfile = fopen("./cloud/cloudkey.txt", "r") or die('{"status": 800, "message": "Server error."}');
if($myfile){
    $data = ['cloud_key' => fgets($myfile)];
    //if(fgets($myfile);
} else {
    $data = errorMessage(800);
}

fclose($myfile);

//echo str_replace("-", "", UUID::v4())."\n";
