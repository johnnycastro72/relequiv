<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Nivel.php";
//Creamos el objeto Nivel
$objNivel = new Nivel();
$resultado = $objNivel->borrarNivel($_REQUEST['idNivel']);
if ($resultado)
    header ("location:../vista/nivel-vista.php");
else
    header ("location:../vista/niveldel-v.php?idNivel=0&msj=2");
?>