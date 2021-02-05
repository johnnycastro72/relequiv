<?php session_start();
    extract ($_REQUEST);
    if(isset($_SESSION['usuario'])){
        require "../modelo/conectar.php";
        require "../modelo/Aprendiz.php";
        require "../modelo/Fase.php";
        require "../modelo/Prueba.php";
        require "../modelo/Modelo.php";
        require "../modelo/Resultado.php";
        require "../modelo/Fallido.php";
        require "../modelo/Fallares.php";
        //Creamos el objeto Aprendiz, Fase, Resultado, Fallido, Fallares, Prueba, Modelo
        $objAprendiz = new Aprendiz();
        $objFase = new Fase();
        $objResultado = new Resultado();
        $objFallido = new Fallido();
        $objFallares = new Fallares();
        $objPrueba = new Prueba();
        $objModelo = new Modelo();
        $resAprendiz = $objAprendiz->consultarAprendices3();
        while ($fila = $resAprendiz->fetch(PDO::FETCH_ASSOC))
        {
            $resFase = $objFase->consultarFases($fila["idModelo"]);
            while ($fase = $resFase->fetch(PDO::FETCH_ASSOC))
            {
                $respuestas = $objResultado->contarFase($fila["idPrueba"], $fase["idFase"], $fila["idAprendiz"]);
                if ($respuestas < $fase["Numero_Preguntas"]){
                    $resFallido = $objFallido->crearAprendiz(0, $fila["Cedula"], $fila["Apellido1"], $fila["Apellido2"], $fila["Nombre1"], $fila["Nombre2"], $fila["FechaNacimiento"], $fila["Sexo"], $fila["idModelo"], $fila["idPrueba"], $fila["idCarrera"], $fila["idSemestre"], $fila["idNivel"], $fila["FechaHora"]);
                    $resFallido = $objFallido->agregarAprendiz();
                    $resFallido = $objFallido->consultarCedula($fila["Cedula"], $fila["idPrueba"]);
                    $fallido = $resFallido->fetch(PDO::FETCH_ASSOC);
                    $idAprendiz = $fila["idAprendiz"];
                    $resResultado = $objResultado->consultaResultados($idAprendiz);
                    while ($resultado = $resResultado->fetch(PDO::FETCH_ASSOC))
                    {
                        $resFallares = $objFallares->crearResultado(0, $fallido["idAprendiz"], $resultado["idPregunta"], $resultado["Acierto"], $resultado["Tiempo"], $resultado["Intento"], $resultado["idPrueba"], $resultado["idModelo"], $resultado["idFase"]);
                        $resFallares = $objFallares->agregarResultado();
                    }
                    $delResultado = $objResultado->borrarResultado($idAprendiz);
                    $delAprendiz = $objAprendiz->borrarAprendiz($idAprendiz);
                    $resPrueba = $objPrueba->restarAprendiz($fila["idPrueba"]);
                    $resModelo = $objModelo->restarAprendiz($fila["idModelo"]);
                    break 1;
                }
            }
        }
        if($_SESSION['nivel']==1){
            require '../vista/principal-vista.php';
        } else {
            require '../vista/test-vista.php';
        }
    } else {
        header ('location: login.php');
    }
?>