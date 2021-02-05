<?php session_start();
    extract ($_REQUEST);
    if (!isset($_REQUEST['msj']))
       $msj=0;
    if(isset($_SESSION['usuario'])){
        require '../vista/pruebaadd-v.php';
    }else{
        header ('location: login.php');
    }
?>