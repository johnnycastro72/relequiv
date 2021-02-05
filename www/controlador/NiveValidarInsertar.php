<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Nivel.php";
//Creamos el objeto Nivel
$objNivel = new Nivel();
$resultado = $objNivel->checkNivel($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/niveladd-v.php?msj=3");
else    
    $objNivel->CrearNivel($_REQUEST['idNivel'],$_REQUEST['Nombre']);
    $resultado = $objNivel->agregarNivel();
    if ($resultado)
        header ("location:../vista/niveladd-v.php?msj=1");
    else
        header ("location:../vista/niveladd-v.php?msj=2");
?>