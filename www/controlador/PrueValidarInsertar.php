<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Prueba.php";
require "../modelo/Usuario.php";
require "../modelo/Modelo.php";
//Creamos el objeto Prueba y usuario
$objUsuario = new User();
$idUsuario = $objUsuario->getActualUser($_SESSION['usuario']);
$objModelo = new Modelo();
$maximo = $_REQUEST['Numero_Aprendiz'] * $objModelo->contarModelos();
$cantidad = 0;
$objPrueba = new Prueba();
$objPrueba->CrearPrueba($_REQUEST['idPrueba'], $_REQUEST['Fecha'], $_REQUEST['Ubicacion'], $_REQUEST['Numero_Aprendiz'], $idUsuario, $maximo, $cantidad);
$resultado = $objPrueba->agregarPrueba();
if ($resultado)
    header ("location:../vista/pruebaadd-v.php?msj=1");
else
    header ("location:../vista/pruebaadd-v.php?msj=2");
?>