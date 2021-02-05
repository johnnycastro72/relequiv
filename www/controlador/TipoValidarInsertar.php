<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Tipo.php";
//Creamos el objeto Tipo
$objTipo = new Tipo();
$resultado = $objTipo->checkTipo($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/tipoadd-vista.php?msj=3");
else    
    $objTipo->CrearTipo($_REQUEST['idTipoEstimulo'],$_REQUEST['Nombre']);
    $resultado = $objTipo->agregarTipo();
    if ($resultado)
        header ("location:../vista/tipoadd-vista.php?msj=1");
    else
        header ("location:../vista/tipoadd-vista.php?msj=2");
?>