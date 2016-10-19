<?php
    $target_dir = "tmp/";
    $nombre = $_FILES["fichero"]["name"];
    $nombre_tmp = $_FILES["fichero"]["tmp_name"];
    $target_file = $target_dir . $nombre;

    $uploadOk = 1;
    $fileType = pathinfo($target_file,PATHINFO_EXTENSION);

    //Comprobar si el archivo ya exite
    if (file_exists($target_file)) {
        echo "El archivo JSON ya existe";
        $uploadOk = 0;
    }
    //Comprobar tamaño del archivo
    if ($_FILES["fichero"]["size"] > 10000) {
        echo "El archivo JSON es demasiado grande";
        $uploadOk = 0;
    }
    //Comprobar extension del archivo
    if($fileType != "json") {
        echo "El archivo subido no es JSON";
        $uploadOk = 0;
    }
    //Si uploadOk es 0 ha habido algun error
    if ($uploadOk == 0) {
        echo "El archivo no ha podido subirse";
    //En caso contrario no ha habido ningun problema
    } else {
        //Comprobar que aun teniendo extension JSON, el contenido es el de un archivo JSON
        $str_contenido = file_get_contents($nombre_tmp);
        $json = json_decode($str_contenido, true);
        file_put_contents($target_file, json_encode($json));
        echo "El archivo ". $nombre. " ha sido subido";
    }
?>