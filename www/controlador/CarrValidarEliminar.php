<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Carrera.php";
//Creamos el objeto Carrera
$objCarrera = new Carrera();
$resultado = $objCarrera->borrarCarrera($_REQUEST['idCarrera']);
if ($resultado)
    header ("location:../vista/carrera-vista.php");
else
    header ("location:../vista/carreradel-v.php?idCarrera=0&msj=2");
?>