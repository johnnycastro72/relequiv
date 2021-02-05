<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Carrera.php";
//Creamos el objeto Carrera
$objCarrera = new Carrera();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idCarrera = $_REQUEST["idCarrera"];
$Nombre = $_REQUEST["Nombre"];
$objCarrera->CrearCarrera($idCarrera, $Nombre);

$resultado = $objCarrera->editarCarrera($_REQUEST['idCarrera']);
if ($resultado)
    header ("location:../vista/carrera-vista.php");
else
    header ("location:../vista/carreraedit-v.php?idCarrera=0&msj=2");
?>