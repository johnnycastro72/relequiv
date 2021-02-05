<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idNivel']))
            header ('location: ../vista/niveldel-v.php?idNivel='.$_REQUEST['idNivel']);
    }else{
        header ('location: login.php');
    }
?>