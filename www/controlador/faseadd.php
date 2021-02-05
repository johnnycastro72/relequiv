<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if(isset($_REQUEST['idModelo'])){
            header ('../vista/faseadd-v.php?idModelo=' . $_REQUEST['idModelo']);
        } else {
            require '../vista/faseadd-v.php';
        }
    }else{
        header ('location: login.php');
    }
?>