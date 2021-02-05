<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPrueba"])){
            $idPrueba = $_GET["idPrueba"];
            $idModelo = $_GET["idModelo"];
            header ('Content-type:application/xls; charset=UTF-8');
            header ('Content-Disposition: attachment; filename=gruresxls' . $idPrueba . $idModelo . '.xls');

            function CalculaEdad( $fecha ) {
                list($Y,$m,$d) = explode("-",$fecha);
                return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
            }
                
            require "../modelo/conectar.php";
            require "../modelo/Aprendiz.php";
            require "../modelo/Nivel.php";
            require "../modelo/Carrera.php";
            require "../modelo/Semestre.php";
            require "../modelo/Resultado.php";
            require "../modelo/Fase.php";

            //Creamos el objeto Aprendiz, Nivel, Carrera, Semestre, Resultado, Fase
            $objAprendiz = new Aprendiz();
            $objNivel = new Nivel();
            $objCarrera = new Carrera();
            $objSemestre = new Semestre();
            $objResultado = new Resultado();
            $objFase = new Fase();

            if ($idPrueba <> -1) {
                echo "<table>";
                echo "<caption>Resultados Grupales</caption>";
                echo "<tr>";
                echo "<th>" . utf8_decode("Identificación") . "</th>";
                echo "<th>Apellidos</th>";
                echo "<th>Nombres</th>";
                echo "<th>Edad</th>";
                echo "<th>Genero</th>";
                echo "<th>" . utf8_decode("Nivel Acádemico") . "</th>";
                echo "<th>Carrera</th>";
                echo "<th>Semestre</th>";
                echo "<th>" . utf8_decode("Tiempo Evaluación") . "</th>";
                echo "<th>Aciertos</th>";
                echo "<th>Errores</th>";
                echo "</tr>";
                $tiempo = 0;
                $aciertos = 0;
                $errores = 0;
                $sexo = ["Masculino", "Femenino"];
                $total = $objAprendiz->contarAprendiz2($idPrueba, $idModelo);
                $resultado = $objAprendiz->consultarAprendices2($idPrueba, $idModelo);
                $idfase = $objFase->evaluacion($idModelo);
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                {
                    $edad = CalculaEdad($fila["FechaNacimiento"]);
                    echo "<tr>";
                    echo "<td align='center'>" . $fila["Cedula"] . "</td>";
                    echo "<td align='center'>" . utf8_decode(trim($fila["Apellido1"] . ' ' . $fila["Apellido2"])) . "</td>";
                    echo "<td align='center'>" . utf8_decode(trim($fila["Nombre1"] . ' ' . $fila["Nombre2"])) . "</td>";
                    echo "<td>" . $edad . "</td>";
                    echo "<td>" . $sexo[$fila["Sexo"]-1] . "</td>";
                    $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
                    $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
                    echo "<td>" . utf8_decode($nivel["Nombre"]) . "</td>";
                    $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
                    $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
                    echo "<td>" . utf8_decode($carrera["Nombre"]) . "</td>";
                    $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
                    $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
                    echo "<td>" . utf8_decode($semestre["Nombre"]) . "</td>";
                    $evaluacion = $objResultado->tiempoEvaluacion($fila["idAprendiz"], $idfase);
                    $acierto = $objResultado->aciertos($fila["idAprendiz"], $idfase);
                    $error = $objResultado->errores($fila["idAprendiz"], $idfase);
                    echo "<td>" . $evaluacion . "</td>";
                    echo "<td>" . $acierto . "</td>";
                    echo "<td>" . $error . "</td>";
                    echo "</tr>";
                    $tiempo = $tiempo + $evaluacion;
                    $aciertos = $aciertos + $acierto;
                    $errores = $errores + $error;
                }
                echo '<tr">';
                echo '<td colspan="8" style="font-weight:bold; background: #ccc;">PROMEDIO :</td>';
                echo '<td style="font-weight:bold; background: #ccc;">' . $tiempo/$total . '</td>';
                echo '<td style="font-weight:bold; background: #ccc;">' . $aciertos/$total . '</td>';
                echo '<td style="font-weight:bold; background: #ccc;">' . $errores/$total . '</td>';
                echo "</tr>";
                echo "</table>";
            }
        }
    } else {
        header ('location: login.php');
    }
?>