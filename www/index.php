<?php session_start();

    if(isset($_SESSION['usuario'])) {
        header('location: controlador/principal.php');
    }else{
        header('location: controlador/login.php');
    }
?>