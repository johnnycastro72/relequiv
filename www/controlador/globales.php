<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/globales-vista.php';
    }else{
        header ('location: login.php');
    }
?>