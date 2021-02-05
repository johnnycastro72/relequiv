<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/gruporesu-vista.php';
    }else{
        header ('location: login.php');
    }
?>