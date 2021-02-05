<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Fase.php";
//Creamos el objeto Fase
$objFase = new Fase();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idFase = $_REQUEST["idFase"];
$Nombre = $_REQUEST["Nombre"];
if (!isset($_REQUEST['Evaluacion'])){
    $Evaluacion = 0;
} else {
    $Evaluacion = 1;
}
$Numero_Preguntas = $_REQUEST['Numero_Preguntas'];
if (isset($_REQUEST['Acertividad'])){
    $Acertividad = 1;
} else {
    $Acertividad = 0;
}
$idModelo = $_REQUEST['idModelo'];
$TiempoMuestra = $_REQUEST['TiempoMuestra'];
$TiempoEstimulo = $_REQUEST['TiempoEstimulo'];
$TiempoEspera = $_REQUEST['TiempoEspera'];
if (isset($_REQUEST['Diccionario'])){
    $Diccionario = 1;
} else {
    $Diccionario = 0;
}
$objFase->CrearFase($idFase,$Nombre,$Evaluacion,$Numero_Preguntas,$Acertividad,$idModelo, $TiempoMuestra, $TiempoEstimulo, $TiempoEspera, $Diccionario);

$resultado = $objFase->editarFase($_REQUEST['idFase']);
if ($resultado)
    header ("location:../vista/fase-vista.php?idModelo=" . $idModelo);
else
    header ("location:../vista/faseedit-v.php?idFase=0&msj=2");
?>