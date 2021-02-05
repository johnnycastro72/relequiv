<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Estimulo.php";
//Creamos el objeto Estimulo
$objEstimulo = new Estimulo();
$resultado = $objEstimulo->borrarEstimulo($_REQUEST['idEstimulo']);
if ($resultado)
    header ("location:../vista/estimulo-vista.php");
else
    header ("location:../vista/estimulodel-v.php?idEstimulo=0&msj=2");
?>