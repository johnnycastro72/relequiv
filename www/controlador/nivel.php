<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/nivel-vista.php';
    }else{
        header ('location: login.php');
    }
?>