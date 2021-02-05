<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idSemestre']))
            header ('location: ../vista/semestredel-v.php?idSemestre='.$_REQUEST['idSemestre']);
    }else{
        header ('location: login.php');
    }
?>