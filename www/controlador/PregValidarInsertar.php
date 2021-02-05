<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Pregunta.php";
require "../modelo/Fase.php";
$idPregunta = $_REQUEST["idPregunta"];
$idFase = $_REQUEST['idFase'];
$idModelo = $_REQUEST['idModelo'];
if (isset($_REQUEST['idTipoMuestra'])){
    $idTipoMuestra = $_REQUEST['idTipoMuestra'];
} else {
    $idTipoMuestra = 1;
}
if (isset($_REQUEST['idTipoEstimulo'])){
    $idTipoEstimulo = $_REQUEST['idTipoEstimulo'];
} else {
    $idTipoEstimulo = 1;
}
if (isset($_REQUEST['idMuestra'])){
    $idMuestra = $_REQUEST['idMuestra'];
} else {
    $idMuestra = 1;
}
if (isset($_REQUEST['Entrenamiento'])){
    $Entrenamiento = 1;
} else {
    $Entrenamiento = 0;
}
$FraseMuestra = $_REQUEST['FraseMuestra'];
if (isset($_REQUEST['FraseEstimulo'])){
    $FraseEstimulo = $_REQUEST['FraseEstimulo'];
} else {
    $FraseEstimulo = "";
}
$FraseFinal = "";

//Creamos el objeto Fase
$objFase = new Fase();
$resFase = $objFase->ConsultarFase($idFase);
$fase = $resFase->fetch(PDO::FETCH_ASSOC);
$uploadOk = 1;
if ($fase["Diccionario"] == 1){
    $image_dir = "../recursos/";
    $image_file = $image_dir . basename($_FILES["FraseFinal"]["name"]);
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
            $check = getimagesize($_FILES["FraseFinal"]["tmp_name"]);
            if($check !== false) {
            } else {
                $mensaje = 5;
                $uploadOk = 0;
            }
        }
    }
    // Verifica el tamaño del archivo
    if ($uploadOk == 1) {
        if ($_FILES["FraseFinal"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["FraseFinal"]["tmp_name"], $image_file)) {
            $FraseFinal = $image_file;
        } else {
            $mensaje = 9;
            $uploadOk = 0;
        }
    }
} else {
    $FraseFinal = $_REQUEST['FraseFinal'];
}

if ($uploadOk == 1) {
    //Creamos el objeto Pregunta
    $objPregunta = new Pregunta();

    $objPregunta->CrearPregunta($idPregunta,$idFase, $idTipoMuestra, $idTipoEstimulo, $idMuestra, $Entrenamiento, $FraseMuestra, $FraseEstimulo, $FraseFinal);
    
    $resultado = $objPregunta->agregarPregunta();
    if ($resultado)
        header ("location:../vista/pregadd-v.php?msj=1&idFase=" . $idFase . "&idModelo=" . $idModelo);
    else
        header ("location:../vista/pregadd-v.php?msj=2&idFase=" . $idFase . "&idModelo=" . $idModelo);
}
?>    
