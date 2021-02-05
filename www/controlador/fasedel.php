<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        if (isset($_REQUEST['idFase']))
            if(isset($_REQUEST['idModelo'])){
                header ('location: ../vista/fasedel-v.php?idFase=' . $_REQUEST['idFase'] . '&idModelo=' . $_REQUEST['idModelo']);
            } else {
                header ('location: ../vista/fasedel-v.php?idFase=' . $_REQUEST['idFase']);
            }
    }else{
        header ('location: login.php');
    }
?>