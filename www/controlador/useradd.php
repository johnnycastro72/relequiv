<?php session_start();
    extract ($_REQUEST);
    if (!isset($_REQUEST['msj']))
       $msj=0;
    if(isset($_SESSION['usuario'])){
        require '../vista/useradd-vista.php';
    }else{
        header ('location: login.php');
    }
?>