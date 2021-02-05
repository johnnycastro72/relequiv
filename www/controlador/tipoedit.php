<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idTipo']))
            header ('location: ../vista/tipoedit-vista.php?idTipo='.$_REQUEST['idTipo']);
    }else{
        header ('location: login.php');
    }
?>