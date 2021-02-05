<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/tipo-vista.php';
    }else{
        header ('location: login.php');
    }
?>