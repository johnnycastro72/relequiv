<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style7.css">
        <?php
            extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
            require "../modelo/conectar.php";
            require "../modelo/Fase.php";
            require "../modelo/Pregunta.php";
            require "../modelo/Resultado.php";
            //Creamos el objeto Fase, Pregunta y Resultado.
            $idPrueba = $_REQUEST["idPrueba"];
            $idModelo = $_REQUEST["idModelo"];
            $idAprendiz = $_REQUEST["idAprendiz"];
            $idFase = $_REQUEST["idFase"];
            $idPregunta = $_REQUEST["idPregunta"];
            $inicio = $_REQUEST["inicio"];
            $intento = $_REQUEST["intento"];
            if (isset($_REQUEST["acierto"])) {
                $acierto = $_REQUEST["acierto"];
            } else {
                $acierto = 0;
            }
            if ($intento > 1) {
                $acierto = 0;
            }
            $objFase = new Fase();
            $resFase = $objFase->consultarFase($idFase);
            $fase = $resFase->fetch(PDO::FETCH_ASSOC);
            $resFases = $objFase->consultarFases($idModelo);
            $objPregunta = new Pregunta();
            $resPreguntas = $objPregunta->consultarPreguntas($idFase);
            $resPregunta = $objPregunta->consultarPregunta($idPregunta);
            $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
            $entrenamiento = $pregunta["Entrenamiento"];
            $tiempo = microtime(true) - $inicio;
            if ($entrenamiento == 0){
                $objResultado = new Resultado();
                $resResultado = $objResultado->crearResultado(0,$idAprendiz, $idPregunta, $acierto, $tiempo, $intento, $idPrueba, $idModelo, $idFase);
                if (($fase["Evaluacion"] == 1) and ($intento>1)) {
                } else {
                    $resResultado = $objResultado->agregarResultado();
                }
            }
            if ((!empty($pregunta["FraseFinal"])) && ($fase["Diccionario"] == 0)) {
                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarff.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '" />';
            } else {
                $inicio = microtime(true);
                // saber si es la ultima pregunta
                while ($preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC))
                {
                    if ($preguntas["idPregunta"] == $pregunta["idPregunta"]) {
                        break;
                    }
                }
                if ($preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC)) {
                    $idPregunta = $preguntas["idPregunta"];
                    $resPregunta = $objPregunta->consultarPregunta($idPregunta);
                    $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                    $up = 0;
                } else {
                    $up = 1;
                }

                // saber si es la ultima fase
                if ($up == 1) {
                    $acertividad = true;
                    if ($fase["Acertividad"] == 1) {
                        $objResultado = new Resultado();
                        $acertividad = $objResultado->acertoResultado($idPrueba, $idFase, $idAprendiz, $fase["Numero_Preguntas"]);
                    } elseif (!empty($fase["TiempoEstimulo"])) {
                        $objResultado = new Resultado();
                        $cuantos = $objResultado->contarFase($idPrueba, $idFase, $idAprendiz);
                        if ($cuantos < $fase["Numero_Preguntas"]) {
                            $acertividad = false;
                        }
                    }
                    if ($acertividad) {
                        while ($fases = $resFases->fetch(PDO::FETCH_ASSOC))
                        {
                            if ($fases["idFase"] == $fase["idFase"]) {
                                break;
                            }
                        }
                        if ($fases = $resFases->fetch(PDO::FETCH_ASSOC)) {
                            $idFase = $fases["idFase"];
                            $resPreguntas = $objPregunta->consultarPreguntas($idFase);
                            $preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC);
                            $idPregunta = $preguntas["idPregunta"];
                            $resPregunta = $objPregunta->consultarPregunta($idPregunta);
                            $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                            $inicio = microtime(true);
                            if (!empty($pregunta["FraseMuestra"])){
                                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                            } elseif ($fase["Diccionario"] == 1) {
                                if (!empty($pregunta["FraseEstimulo"])){
                                    echo '<meta http-equiv="Refresh" content="0;url=../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                                }
                            } else {
                                if ($fase["Evaluacion"] == 1) {
                                        echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                                } else {
                                    if (!empty($pregunta["idMuestra"])){
                                        echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                                    }
                                }
                            }
                        } else {
                            echo '<meta http-equiv="Refresh" content="0;url=../controlador/cerrar.php" />';
                        }
                    } else {
                        $resPreguntas = $objPregunta->consultarPreguntas($idFase);
                        $preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC);
                        if ($preguntas["Entrenamiento"] == 1) {
                            $preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC);
                        }
                        $idPregunta = $preguntas["idPregunta"];
                        $resPregunta = $objPregunta->consultarPregunta($idPregunta);
                        $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                        $inicio = microtime(true);
                        if (!empty($pregunta["FraseMuestra"])){
                            echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                        } elseif ($fase["Diccionario"] == 1) {
                            if (!empty($pregunta["FraseEstimulo"])){
                                echo '<meta http-equiv="Refresh" content="0;url=../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                            }
                        } else {
                            if ($fase["Evaluacion"] == 1) {
                                    echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                            } else {
                                if (!empty($pregunta["idMuestra"])){
                                    echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                                }
                            }
                        }
                    }
                } else {
                    $inicio = microtime(true);
                    if (!empty($pregunta["FraseMuestra"])){
                        echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                    } elseif ($fase["Diccionario"] == 1) {
                        if (!empty($pregunta["FraseEstimulo"])){
                            echo '<meta http-equiv="Refresh" content="0;url=../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                        }
                    } else {
                        if ($fase["Evaluacion"] == 1) {
                                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                        } else {
                            if (!empty($pregunta["idMuestra"])){
                                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEspera"] . ';url=../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio . '" />';
                            }
                        }
                    }
                }
            }
        ?>
	</head>
	<body>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/menu.js"></script>
	</body>
</html>