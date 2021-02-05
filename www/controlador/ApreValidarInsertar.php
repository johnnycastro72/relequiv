<?php
session_start();
extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
require "../modelo/conectar.php";
require "../modelo/Aprendiz.php";
require "../modelo/Modelo.php";
require "../modelo/Prueba.php";
require "../modelo/Resultado.php";
require "../modelo/Fase.php";
require "../modelo/Pregunta.php";
//Creamos el objeto Aprendiz, Modelo, Prueba y Resultado.
$objPrueba = new Prueba();
$resPrueba = $objPrueba->ultimaPrueba();
$prueba = $resPrueba->fetch(PDO::FETCH_ASSOC);
$idPrueba = $prueba["idPrueba"];
$objAprendiz = new Aprendiz();
$objResultado = new Resultado();
$objModelo = new Modelo();
$idModelo = 0;
$mensaje = 0;
if ($prueba["cantidadAprendices"] < $prueba["maximoAprendices"]) {
    while ($idModelo == 0){
        $resModelo = $objModelo->random();
        $modelo    = $resModelo->fetch(PDO::FETCH_ASSOC);
        $idModelo  = $modelo["idModelo"];
        $resResultado = $objResultado->contarResultados($idPrueba, $idModelo);
        if ($resResultado < $prueba["Numero_Aprendiz"]){
           break; 
        } else {
            $idModelo = 0;
        }
    }

    if ($idModelo>0) {
        $Apellido1 = strtoupper($_REQUEST['Apellido1']);
        $Apellido2 = strtoupper($_REQUEST['Apellido2']);
        $Nombre1 = strtoupper($_REQUEST['Nombre1']);
        $Nombre2 = strtoupper($_REQUEST['Nombre2']);
        $FechaHora = date("Y-m-d H:i:s");
        $objAprendiz->CrearAprendiz($_REQUEST['idAprendiz'], $_REQUEST['Cedula'], $Apellido1, $Apellido2, $Nombre1, $Nombre2, $_REQUEST['FechaNacimiento'], $_REQUEST['Sexo'], $idModelo, $idPrueba, $_REQUEST['idCarrera'], $_REQUEST['idSemestre'], $_REQUEST['idNivel'], $FechaHora);
        $resAprendiz = $objAprendiz->agregarAprendiz();

        if ($resAprendiz){
            $resAprendiz = $objAprendiz->consultarCedula($_REQUEST['Cedula'], $idPrueba);
            $aprendiz = $resAprendiz->fetch(PDO::FETCH_ASSOC);
            $resPrueba = $objPrueba->agregarAprendiz($idPrueba);

            if ($resPrueba){
                $resModelo = $objModelo->agregarAprendiz($idModelo);

                if ($resModelo) {
                    $objFase = new Fase();
                    $resFase = $objFase->consultarFases($idModelo);
                    $objPregunta = new Pregunta();
                    $fase = $resFase->fetch(PDO::FETCH_ASSOC);
                    $resPregunta = $objPregunta->consultarPreguntas($fase["idFase"]);
                    $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                    $idFase = $fase["idFase"];
                    $idPregunta = $pregunta["idPregunta"];
                    $idAprendiz = $aprendiz["idAprendiz"];
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
                } else {
                    $mensaje = 5;
                } 
            } else {
                 $mensaje = 4;
            }
        } else {
            $mensaje = 3;
        }
    }
} else {
    header ('location: ../controlador/cerrar.php');
    exit();
}
exit($mensaje);
?>