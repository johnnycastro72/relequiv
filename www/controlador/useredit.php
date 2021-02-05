<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idUsuario']))
            header ('location: ../vista/useredit-vista.php?idUsuario='.$_REQUEST['idUsuario']);
    }else{
        header ('location: login.php');
    }
?>