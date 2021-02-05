<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Semestre.php";
//Creamos el objeto Semestre
$objSemestre = new Semestre();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idSemestre = $_REQUEST["idSemestre"];
$Nombre = $_REQUEST["Nombre"];
$objSemestre->CrearSemestre($idSemestre, $Nombre);

$resultado = $objSemestre->editarSemestre($_REQUEST['idSemestre']);
if ($resultado)
    header ("location:../vista/semestre-vista.php");
else
    header ("location:../vista/semestreedit-v.php?idSemestre=0&msj=2");
?>