<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/grupodemo-vista.php';
    }else{
        header ('location: login.php');
    }
?>