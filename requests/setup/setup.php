<?php

include "./resources/uuid.php";

$myfile = fopen("./cloud/cloudkey.txt", "w") or die('{"status": 800, "message": "Server error."}');
if($myfile){
    $cloud_key = str_replace("-", "", UUID::v4());
    fwrite($myfile, $cloud_key);
    $data = ['cloud_key' => $cloud_key];
} else {
    $data = errorMessage(800);
}

fclose($myfile);
