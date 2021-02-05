<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/prueba-vista.php';
    }else{
        header ('location: login.php');
    }
?>