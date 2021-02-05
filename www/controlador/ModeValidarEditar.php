<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Modelo.php";
//Creamos el objeto Modelo
$objFase = new Modelo();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idModelo = $_REQUEST["idModelo"];
$Nombre = $_REQUEST["Nombre"];
$objModelo->CrearModelo($idModelo,$Nombre);

$resultado = $objModelo->editarModelo($_REQUEST['idModelo']);
if ($resultado)
    header ("location:../vista/modelo-vista.php");
else
    header ("location:../vista/modeedit-v.php?idModelo=0&msj=2");
?>