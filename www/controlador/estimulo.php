<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/estimulo-vista.php';
    }else{
        header ('location: login.php');
    }
?>