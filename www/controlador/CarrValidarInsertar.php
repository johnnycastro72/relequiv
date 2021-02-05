<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Carrera.php";
//Creamos el objeto Carrera
$objCarrera = new Carrera();
$resultado = $objCarrera->checkCarrera($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/carreraadd-v.php?msj=3");
else    
    $objCarrera->CrearCarrera($_REQUEST['idCarrera'],$_REQUEST['Nombre']);
    $resultado = $objCarrera->agregarCarrera();
    if ($resultado)
        header ("location:../vista/carreraadd-v.php?msj=1");
    else
        header ("location:../vista/carreraadd-v.php?msj=2");
?>