<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idCarrera']))
            header ('location: ../vista/carreradel-v.php?idCarrera='.$_REQUEST['idCarrera']);
    }else{
        header ('location: login.php');
    }
?>