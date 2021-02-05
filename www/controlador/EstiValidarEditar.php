<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Estimulo.php";
//Creamos el objeto Estimulo
$objEstimulo = new Estimulo();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idEstimulo = $_REQUEST["idEstimulo"];
$Palabra = $_REQUEST["Palabra"];
$Imagen = $_POST["Imagen"];
$Kanji = $_REQUEST["Kanji"];
$objEstimulo->CrearEstimulo($idEstimulo, $Palabra, $Imagen, $Kanji);

$resultado = $objEstimulo->editarEstimulo($_REQUEST['idEstimulo']);
if ($resultado)
    header ("location:../vista/estimulo-vista.php");
else
    header ("location:../vista/estimuloedit-v.php?idEstimulo=0&msj=2");
?>