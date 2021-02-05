<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/semestre-vista.php';
    }else{
        header ('location: login.php');
    }
?>