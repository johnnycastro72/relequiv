<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPregunta"])){
            header ('location: ../vista/preguntarfm-v.php?idPregunta=' . $_GET["idPregunta"] . '&idFase=' . $_GET["idFase"] . '&idModelo=' . $_GET["idModelo"] . '&idPrueba=' . $_GET["idPrueba"] . '&idAprendiz=' . $_GET["idAprendiz"] . "&inicio=" . $_GET["inicio"]);
        } else {
            require '../vista/preguntarfm-v.php';
        }
    }else{
        header ('location: login.php');
    }
?>