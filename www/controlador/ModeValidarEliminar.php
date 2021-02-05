<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Modelo.php";
//Creamos el objeto Modelo
$objModelo = new Modelo();
$resultado = $objModelo->borrarModelo($_REQUEST['idModelo']);
if ($resultado)
    header ("location:../vista/modelo-vista.php");
else
    header ("location:../vista/modelodel-v.php?idModelo=0&msj=2");
?>