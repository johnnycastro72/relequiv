<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Fase.php";
//Creamos el objeto Fase
$idFase = $_REQUEST['idFase'];
$Nombre = $_REQUEST['Nombre'];
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
$objFase = new Fase();
$resultado = $objFase->checkFase($Nombre,$idModelo);
if ($resultado>0){
	header ("location:../vista/faseadd-v.php?msj=3&idModelo=".$idModelo);
} else {    
    $objFase->CrearFase($idFase,$Nombre,$Evaluacion,$Numero_Preguntas,$Acertividad,$idModelo, $TiempoMuestra, $TiempoEstimulo, $TiempoEspera, $Diccionario);
    $resultado = $objFase->agregarFase();
    if ($resultado)
        header ("location:../vista/faseadd-v.php?msj=1&idModelo=".$idModelo);
    else
        header ("location:../vista/faseadd-v.php?msj=2&idModelo=".$idModelo);
}
?>