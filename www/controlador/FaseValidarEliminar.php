<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Fase.php";
//Creamos el objeto Fase
$idModelo = $_REQUEST['idModelo'];
$objFase = new Fase();
$resultado = $objFase->borrarFase($_REQUEST['idFase']);
if ($resultado)
    header ("location:../vista/fase-vista.php?idModelo=" . $idModelo);
else
    header ("location:../vista/fasedel-v.php?idFase=0&msj=2");
?>