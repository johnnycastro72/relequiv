<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Modelo.php";
//Creamos el objeto Modelo
$objModelo = new Modelo();
$resultado = $objModelo->checkModelo($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/modeloadd-v.php?msj=3");
else    
    $objModelo->CrearModelo($_REQUEST['idModelo'],$_REQUEST['Nombre']);
    $resultado = $objModelo->agregarModelo();
    if ($resultado)
        header ("location:../vista/modeloadd-v.php?msj=1");
    else
        header ("location:../vista/modeloadd-v.php?msj=2");
?>