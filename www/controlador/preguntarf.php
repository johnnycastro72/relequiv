<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPregunta"])){
            header ('location: ../vista/preguntarf-v.php?idPregunta=' . $_GET["idPregunta"] . '&idFase=' . $_GET["idFase"] . '&idModelo=' . $_GET["idModelo"] . '&idPrueba=' . $_GET["idPrueba"] . '&idAprendiz=' . $_GET["idAprendiz"] . "&inicio=" . $_GET["inicio"] . "&intento=" . $_GET["intento"] . "&acierto=" . $_GET["acierto"]);
        } else {
            require '../vista/preguntarf-v.php';
        }
    }else{
        header ('location: login.php');
    }
?>