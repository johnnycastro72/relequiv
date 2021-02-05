<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idPrueba']))
            header ('location: ../vista/pruebadel-v.php?idPrueba='.$_REQUEST['idPrueba']);
    }else{
        header ('location: login.php');
    }
?>