<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idEstimulo']))
            header ('location: ../vista/estimulodel-v.php?idEstimulo='.$_REQUEST['idEstimulo']);
    }else{
        header ('location: login.php');
    }
?>