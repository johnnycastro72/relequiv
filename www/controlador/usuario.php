<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/usuario-vista.php';
    }else{
        header ('location: login.php');
    }
?>