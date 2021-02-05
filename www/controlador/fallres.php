<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idAprendiz"])){
            header ("location: ../vista/falres-vista.php?idAprendiz=" . $_GET['idAprendiz'] . "&idPrueba=" . $_GET['idPrueba']);
        } else {
            require '../vista/falres-vista.php';
        }
    }else{
        header ('location: login.php');
    }
?>