<?php


//print_r($_FILES);

$files = array(".jpg", ".jpeg", ".gif", ".png");
include "./resources/uuid.php";

//$service = "cfe9e8c03842";
//print_r($_FILES);

if(isset($_FILES['file']) && isset($_POST['service'])){
    $service = $_POST['service'];
    $iName = $_FILES['file']['name'];
    $iTmp  = $_FILES['file']['tmp_name'];
    $fileName = UUID::v4();
    $extension = pathinfo($iName, PATHINFO_EXTENSION);
    
    if(move_uploaded_file($iTmp, "./cloud/services/".$service."/".$fileName.'.'.$extension)){
        $data = ['status' => 200, 'original_name' => $iName, 'new_name' => $fileName.'.'.$extension, 'type' => $_FILES['file']['type'], 'error' => $_FILES['file']['error'], 'size' => $_FILES['file']['size']];
    } else {
        $data = messageError(800);
    }
} else {
    $data = ['status' => 814, 'message' => 'Invalid or missing file and service'];
}