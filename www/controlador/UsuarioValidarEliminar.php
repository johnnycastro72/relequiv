<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Usuario.php";
//Creamos el objeto Usuario
$objUsuario= new User();
$resultado = $objUsuario->borrarUser($_REQUEST['idUsuario']);
if ($resultado)
    header ("location:../vista/usuario-vista.php");
else
    header ("location:../vista/userdel-vista.php?idUsuario=0&msj=2");
?>