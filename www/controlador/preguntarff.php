<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPregunta"])){
            header ('location: ../vista/preguntarff-v.php?idPregunta=' . $_GET["idPregunta"] . '&idFase=' . $_GET["idFase"] . '&idModelo=' . $_GET["idModelo"] . '&idPrueba=' . $_GET["idPrueba"] . '&idAprendiz=' . $_GET["idAprendiz"]);
        } else {
            require '../vista/preguntarff-v.php';
        }
    }else{
        header ('location: login.php');
    }
?>