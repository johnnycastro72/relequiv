<?php session_start();
    if(isset($_SESSION['usuario'])){
        require '../vista/modelo-vista.php';
    }else{
        header ('location: login.php');
    }
?>