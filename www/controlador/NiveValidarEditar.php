<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Nivel.php";
//Creamos el objeto Nivel
$objNivel = new Nivel();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idNivel = $_REQUEST["idNivel"];
$Nombre = $_REQUEST["Nombre"];
$objNivel->CrearNivel($idNivel, $Nombre);

$resultado = $objNivel->editarNivel($_REQUEST['idNivel']);
if ($resultado)
    header ("location:../vista/nivel-vista.php");
else
    header ("location:../vista/niveledit-v.php?idNivel=0&msj=2");
?>