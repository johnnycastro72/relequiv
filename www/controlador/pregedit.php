<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idPregunta']))
            if(isset($_REQUEST['idModelo'])){
                header ('location: ../vista/pregedit-v.php?idPregunta=' . $_REQUEST['idPregunta'] . "&idModelo=" . $_REQUEST['idModelo'] . "&idFase=" . $_REQUEST['idFase']);
            } else {
                header ('location: ../vista/pregedit-v.php?idPregunta=' . $_REQUEST['idPregunta']);
            }
    }else{
        header ('location: login.php');
    }
?>