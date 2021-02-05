<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Fase.php";
require "../modelo/Pregunta.php";
require "../modelo/Resultado.php";
//Creamos el objeto Aprendiz, Fase y Pregunta.
$idPrueba = $_REQUEST["idPrueba"];
$idModelo = $_REQUEST["idModelo"];
$idAprendiz = $_REQUEST["idAprendiz"];
$idFase = $_REQUEST["idFase"];
$idPregunta = $_REQUEST["idPregunta"];
$objFase = new Fase();
$resFases = $objFase->consultarFases($idModelo);
$resFase = $objFase->consultarFase($idFase);
$fase = $resFase->fetch(PDO::FETCH_ASSOC);
$objPregunta = new Pregunta();
$resPreguntas = $objPregunta->consultarPreguntas($idFase);
$resPregunta = $objPregunta->consultarPregunta($idPregunta);
$pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
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
                header ('location: ../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                exit();
            } elseif ($fase["Diccionario"] == 1) {
                if (!empty($pregunta["FraseEstimulo"])){
                    header ('location: ../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                    exit();
                }
            } else {
                if (!empty($pregunta["idMuestra"])){
                    header ('location: ../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                    exit();
                }
            }
        } else {
            header ('location: ../controlador/cerrar.php');
            exit();
        }
    } else {
        $resPreguntas = $objPregunta->consultarPreguntas($idFase);
        $preguntas = $resPreguntas->fetch(PDO::FETCH_ASSOC);
        $idPregunta = $preguntas["idPregunta"];
        $resPregunta = $objPregunta->consultarPregunta($idPregunta);
        $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
        $inicio = microtime(true);
        if (!empty($pregunta["FraseMuestra"])){
            header ('location: ../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        } elseif ($fase["Diccionario"] == 1) {
            if (!empty($pregunta["FraseEstimulo"])){
                header ('location: ../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                exit();
            }
        } else {
            if ($fase["Evaluacion"] == 1){
                header ('location: ../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                exit();
            } else {
                if (!empty($pregunta["idMuestra"])){
                    header ('location: ../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                    exit();
                }
            }
        }
    }
} else {
    $inicio = microtime(true);
    if (!empty($pregunta["FraseMuestra"])){
        header ('location: ../controlador/preguntarfm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
        exit();
    } elseif ($fase["Diccionario"] == 1) {
        if (!empty($pregunta["FraseEstimulo"])){
            header ('location: ../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        }
    } else {
        if ($fase["Evaluacion"] == 1){
            header ('location: ../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
            exit();
        } else {
            if (!empty($pregunta["idMuestra"])){
                header ('location: ../controlador/preguntarm.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . "&inicio=" . $inicio);
                exit();
            }
        }
    }
}

?>