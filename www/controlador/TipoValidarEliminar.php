<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Tipo.php";
//Creamos el objeto Tipo
$objTipo = new Tipo();
$resultado = $objTipo->borrarTipo($_REQUEST['idTipoEstimulo']);
if ($resultado)
    header ("location:../vista/tipo-vista.php");
else
    header ("location:../vista/tipodel-vista.php?idTipo=0&msj=2");
?>