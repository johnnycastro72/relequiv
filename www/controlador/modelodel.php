<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idModelo']))
            header ('location: ../vista/modelodel-v.php?idModelo='.$_REQUEST['idModelo']);
    }else{
        header ('location: login.php');
    }
?>