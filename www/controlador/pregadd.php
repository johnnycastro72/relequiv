<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if(isset($_SESSION['idFase'])){
            header ('location: ../vista/pregadd-v.php?idFase=' . $_REQUEST['idFase'] . '&idModelo=' . $_REQUEST['idModelo']);
        } else {
            require '../vista/pregadd-v.php';
        }
    }else{
        header ('location: login.php');
    }
?>