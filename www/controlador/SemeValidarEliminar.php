<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Semestre.php";
//Creamos el objeto Semestre
$objSemestre = new Semestre();
$resultado = $objSemestre->borrarSemestre($_REQUEST['idSemestre']);
if ($resultado)
    header ("location:../vista/semestre-vista.php");
else
    header ("location:../vista/semestredel-v.php?idSemestre=0&msj=2");
?>