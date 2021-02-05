<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Estimulo.php";
$image_dir = "../recursos/";
$image_file = $image_dir . basename($_FILES["Imagen"]["name"]);
$kanji_dir = "../recursos/";
$kanji_file = $kanji_dir . basename($_FILES["Kanji"]["name"]);
$uploadOk = 1;
$mensaje = 0;
//Creamos el objeto Estimulo
$objEstimulo = new Estimulo();
$resultado   = $objEstimulo->checkEstimulo($_REQUEST['Palabra']);
if ($resultado>0){
    $mensaje = 3;
    $uploadOk = 0;
}
// Verifica si la imagen YA existe
if ($uploadOk == 1) {
    if (file_exists($image_file)) {
        $mensaje = 4;
        $uploadOk = 0;
    }
}
if ($uploadOk == 1) {
    $imageFileType = strtolower(pathinfo($image_file,PATHINFO_EXTENSION));
    // Verifica si el archivo de imagen es una imagen o es falso image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Imagen"]["tmp_name"]);
        if($check !== false) {
        } else {
            $mensaje = 5;
            $uploadOk = 0;
        }
    }
}
// Verifica el tamaño del archivo
if ($uploadOk == 1) {
    if ($_FILES["Imagen"]["size"] > 500000) {
        $mensaje = 6;
        $uploadOk = 0;
    }
}
// Permite solo ciertos tipos de archivo
if ($uploadOk == 1) {
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $mensaje = 7;
        $uploadOk = 0;
    }
}
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["Imagen"]["tmp_name"], $image_file)) {
    } else {
        $mensaje = 9;
        $uploadOk = 0;
    }
}

if ($uploadOk == 1) {
    // Verifica si el kanji YA existe
    if (file_exists($kanji_file)) {
        $mensaje = 10;
        $uploadOk = 0;
    }
}

if ($uploadOk == 1) {
    $imageFileType = strtolower(pathinfo($kanji_file,PATHINFO_EXTENSION));
    // Verifica si el archivo de kanji es una imagen o es falso image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Kanji"]["tmp_name"]);
        if($check !== false) {
        } else {
            $mensaje = 5;
            $uploadOk = 0;
        }
    }
}

if ($uploadOk == 1) {
    // Verifica el tamaño del archivo
    if ($_FILES["Kanji"]["size"] > 500000) {
        $mensaje = 11;
        $uploadOk = 0;
    }
}

if ($uploadOk == 1) {
    // Permite solo ciertos tipos de archivo
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $mensaje = 12;
        $uploadOk = 0;
    }
}

// Si todo está bien trate de cargar el kanji
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["Kanji"]["tmp_name"], $kanji_file)) {
    } else {
        $mensaje = 14;
        $uploadOk = 0;
    }
}

if ($mensaje == 4 or $mensaje == 10) {
    $resultado = $objEstimulo->imagenEstimulo($image_file);
    if ($resultado>0){
        $uploadOk = 0;
    } else {
        $resultado = $objEstimulo->kanjiEstimulo($kanji_file);
        if ($resultado>0){
            $uploadOk = 0;
        } else {
            $uploadOk = 1;
        }
    }
}
    
if ($uploadOk == 1) {
    $objEstimulo->CrearEstimulo($_REQUEST['idEstimulo'],$_REQUEST['Palabra'],$image_file,
                               $kanji_file);
    $resultado = $objEstimulo->agregarEstimulo();
    if ($resultado)
        $mensaje = 1;
    else
        $mensaje = 2;
}

header ("location:../vista/estimuloadd-v.php?msj=".$mensaje);
?>

