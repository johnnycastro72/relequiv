<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Prueba.php";
require "../modelo/Aprendiz.php";
require "../modelo/Resultado.php";
//Creamos el objeto Resultado.
$objResultado = new Resultado();
$resResultado = $objResultado->borrarResultados($_REQUEST['idPrueba']);
if ($resResultado) {
    //Creamos el objeto Aprendiz.
    $objAprendiz = new Aprendiz();
    $resAprendiz = $objAprendiz->borrarAprendices($_REQUEST['idPrueba']);
    if ($resAprendiz) {
        //Creamos el objeto Prueba.
        $objPrueba = new Prueba();
        $resPrueba = $objPrueba->borrarPrueba($_REQUEST['idPrueba']);
        if ($resPrueba) {
            header ("location:../vista/prueba-vista.php");
        } else {
            header ("location:../vista/pruebadel-v.php?idPrueba=0&msj=2");
        }
    } else {
        header ("location:../vista/pruebadel-v.php?idPrueba=0&msj=2");
    }
} else {
    header ("location:../vista/pruebadel-v.php?idPrueba=0&msj=2");
}
    
?>