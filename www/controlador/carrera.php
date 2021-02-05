<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/carrera-vista.php';
    }else{
        header ('location: login.php');
    }
?>