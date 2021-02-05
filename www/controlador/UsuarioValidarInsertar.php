<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Usuario.php";
//Creamos el objeto Usuario
$objUsuario= new User();
$resultado = $objUsuario->checkUser($_REQUEST['Nombre']);
if ($resultado>0)
	header ("location:../vista/useradd-vista.php?msj=3");
else    
    $objUsuario->CrearUser($_REQUEST['idUsuario'],$_REQUEST['Nombre'],$_REQUEST['clave'],
                           $_REQUEST['Nivel']);
    $resultado = $objUsuario->agregarUser();
    if ($resultado)
        header ("location:../vista/useradd-vista.php?msj=1");
    else
        header ("location:../vista/useradd-vista.php?msj=2");
?>