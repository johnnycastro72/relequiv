<?php session_start();

    include('../modelo/conectar.php');

    if(isset($_SESSION['usuario'])) {
        header('location: ../index.php');
    }

    $error = '';
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $usuario = $_POST['usuario'];
        $clave   = $_POST['clave'];
        $clave   = hash('sha512', $clave);
        
        $con = new conectar();
        $conexion = $con->getConnection();
        
        $statement = $conexion->prepare('SELECT * FROM tusuario WHERE nombre = :usuario AND clave = :clave');
        $statement->execute(array(':usuario' => $usuario, ':clave' => $clave));
        $resultado = $statement->fetch();

        if($resultado != false){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['nivel'] = $resultado[3];
            header('location: principal.php');
        }else{
            $error .= '<i>Este usuario no existe</i>';
        }

    }

require '../vista/login-vista.php';

?>