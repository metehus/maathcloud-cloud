<?php
header('Access-Control-Allow-Origin: *');
include('./resources/headers.php');

if(isset($_GET['request']) && isset($_GET['method'])){
    $request = $_GET['request'];
    $method = $_GET['method'];
} else {
    $request = '';
    $method = '';
}

if($request == 'get'){
    if($method == 'files'){
        include('./requests/'.$request.'/'.$method.'.php');
    } else {
        $data = errorMessage(801);
    }
} elseif($request == 'auth'){
    if($method == 'token'){
        include('./requests/'.$request.'/'.$method.'.php');
    } else {
        $data = errorMessage(802);
    }
} elseif($request == 'setup'){
    if($method == 'verify' || $method == 'setup'){
        include('./requests/'.$request.'/'.$method.'.php');
    } else {
        $data = errorMessage(802);
    }
} elseif($request == 'function'){
    if($method == 'upload' || $method == 'newService'){
        include('./requests/'.$request.'/'.$method.'.php');
    } else {
        $data = errorMessage(803);
    }
}  else {
    $data = errorMessage(804);
}


echo json_encode($data);
?>