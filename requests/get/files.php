<?php

$json = json_decode(file_get_contents('php://input'));


if(isset($json->service_folder)){
    $dir = "./cloud/services/".$json->service_folder;

    // Abre um diretorio conhecido, e faz a leitura de seu conteudo

    $files = array();


    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if(is_file($dir.'/'.$file)){
                    $type = 'file';
                } else {
                    $type = 'dir';
                }
                $id = pathinfo($dir.'/'.$file, PATHINFO_FILENAME);
                array_push($files, ['name' => $file, 'id' => $id, 'type' => $type, 'size' => filesize($dir.'/'.$file), 'mime' => mime_content_type($dir.'/'.$file)]);
            }
            $data = $files;
            //var_dump($files);
            closedir($dh);
        } else {
            $data = errorMessage(801);
        }
    } else {
        $data = errorMessage(801);
    }
} else {
    $data = errorMessage(801);
}