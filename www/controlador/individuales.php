<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/individual-vista.php';
    }else{
        header ('location: login.php');
    }
?>