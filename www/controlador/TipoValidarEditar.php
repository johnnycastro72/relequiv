<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Tipo.php";
//Creamos el objeto Tipo
$objTipo = new Tipo();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idTipoEstimulo = $_REQUEST["idTipoEstimulo"];
$Nombre = $_REQUEST["Nombre"];
$objTipo->CrearTipo($idTipoEstimulo, $Nombre);

$resultado = $objTipo->editarTipo($_REQUEST['idTipoEstimulo']);
if ($resultado)
    header ("location:../vista/tipo-vista.php");
else
    header ("location:../vista/tipoedit-vista.php?idTipo=0&msj=2");
?>