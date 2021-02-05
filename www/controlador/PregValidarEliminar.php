<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Pregunta.php";
//Creamos el objeto Pregunta
$idModelo = $_REQUEST['idModelo'];
$idFase = $_REQUEST['idFase'];
$objPregunta = new Pregunta();
$resultado = $objPregunta->borrarPregunta($_REQUEST['idPregunta']);
if ($resultado)
    header ("location:../vista/pregunta-vista.php?idModelo=" . $idModelo . "&idFase=" . $idFase);
else
    header ("location:../vista/preguntadel-v.php?idPregunta=0&msj=2");
?>