<?php

$service = random_str(8, '0123456789abcdef');

$json = json_decode(file_get_contents('php://input'));

include('./resources/uuid.php');

$token = "56e4c1b5-5e0e-4389-9971-fc30467d751c";

$uuid = explode("-", UUID::v4());


$dir = mkdir("./cloud/services/".$uuid[0], 0755);
if($dir){
    $data = ['status' => 200, "service_id" => $uuid[0]];
} else {
    $data = errorMessage(800);
}


