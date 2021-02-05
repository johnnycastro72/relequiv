<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/fallidas-vista.php';
    }else{
        header ('location: login.php');
    }
?>