<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idModelo"])){
            header ('location: ../vista/pregunta-vista.php?idModelo=' . $_GET["idModelo"] . '&idFase=' . $_GET["idFase"]);
        } else {
            require '../vista/pregunta-vista.php';
        }
    }else{
        header ('location: login.php');
    }
?>