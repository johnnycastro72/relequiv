<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Semestre.php";
//Creamos el objeto Semestre
$objSemestre = new Semestre();
$resultado = $objSemestre->checkSemestre($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/semestreadd-v.php?msj=3");
else    
    $objSemestre->CrearSemestre($_REQUEST['idSemestre'],$_REQUEST['Nombre']);
    $resultado = $objSemestre->agregarSemestre();
    if ($resultado)
        header ("location:../vista/semestreadd-v.php?msj=1");
    else
        header ("location:../vista/semestreadd-v.php?msj=2");
?>