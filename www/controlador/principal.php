<?php session_start();
    if(isset($_SESSION['usuario'])){
        if($_SESSION['nivel']==1){
            require '../vista/principal-vista.php';
        }else{
            require '../vista/test-vista.php';
        }
    }else{
        header ('location: login.php');
    }
?>