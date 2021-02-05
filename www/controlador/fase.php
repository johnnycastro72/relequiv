<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idModelo"])){
            header ("location: ../vista/fase-vista.php?idModelo=" . $_GET['idModelo']);
        } else {
            require '../vista/fase-vista.php';
        }
    }else{
        header ('location: login.php');
    }
?>