<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Usuario.php";
//Creamos el objeto Usuario
$objUsuario = new User();
//foreach($_REQUEST as $campo => $valor)  
//echo "$campo -> $valor <br>";  

$idUsuario = $_REQUEST["idUsuario"];
$Nombre = $_REQUEST["Nombre"];
$clave = $_POST["clave"];
$Nivel = $_REQUEST["Nivel"];
$objUsuario->CrearUser($idUsuario, $Nombre, $clave, $Nivel);

$resultado = $objUsuario->editarUser($_REQUEST['idUsuario']);
if ($resultado)
    header ("location:../vista/usuario-vista.php");
else
    header ("location:../vista/useredit-vista.php?idUsuario=0&msj=2");
?>