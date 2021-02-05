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
$FraseFinal = $_REQUEST['FraseFinal'];

//Creamos el objeto Pregunta
$objPregunta = new Pregunta();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$objPregunta->CrearPregunta($idPregunta, $idFase, $idTipoMuestra, $idTipoEstimulo, $idMuestra, $Entrenamiento, $FraseMuestra, $FraseEstimulo, $FraseFinal);

$resultado = $objPregunta->editarPregunta($_REQUEST['idPregunta']);
if ($resultado)
    header ("location:../vista/pregunta-vista.php?idModelo=" . $idModelo . "&idFase=" . $idFase);
else
    header ("location:../vista/preguntaedit-v.php?idPregunta=0&msj=2");
?>