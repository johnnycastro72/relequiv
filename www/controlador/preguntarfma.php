<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Fase.php";
require "../modelo/Pregunta.php";
//Creamos el objeto Aprendiz, Fase y Pregunta.
$idPrueba = $_REQUEST["idPrueba"];
$idModelo = $_REQUEST["idModelo"];
$idAprendiz = $_REQUEST["idAprendiz"];
$idFase = $_REQUEST["idFase"];
$idPregunta = $_REQUEST["idPregunta"];
$inicio = $_REQUEST["inicio"];
$objFase = new Fase();
$resFase = $objFase->consultarFase($idFase);
$fase = $resFase->fetch(PDO::FETCH_ASSOC);
$objPregunta = new Pregunta();
$resPreguntas = $objPregunta->consultarPreguntas($idFase);
$resPregunta = $objPregunta->consultarPregunta($idPregunta);
$pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
if ($fase["Diccionario"] == 1){
    if (!empty($pregunta["FraseEstimulo"])){
        header ('location: ../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
        exit();
    }
} else {
    if ($fase["Evaluacion"] == 1){
        if (!empty($pregunta["FraseEstimulo"])){
            header ('location: ../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        } else {
            header ('location: ../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        }
    } else {
        if (!empty($pregunta["idMuestra"])){
           header ('location: ../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        }
    }
}
?>