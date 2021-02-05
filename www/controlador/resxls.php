<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idAprendiz"])){
            $idAprendiz = $_GET["idAprendiz"];
            header ('Content-type:application/xls; charset=UTF-8');
            header ('Content-Disposition: attachment; filename=resxls' . $idAprendiz . '.xls');

            require "../modelo/conectar.php";
            require "../modelo/Aprendiz.php";
            require "../modelo/Nivel.php";
            require "../modelo/Carrera.php";
            require "../modelo/Semestre.php";
            require "../modelo/Modelo.php";

            function CalculaEdad( $fecha ) {
                list($Y,$m,$d) = explode("-",$fecha);
                return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
            }
                
            //Creamos el objeto Aprendiz, Nivel, Carrera, Semestre, Modelo
            $objAprendiz = new Aprendiz();
            $objNivel = new Nivel();
            $objCarrera = new Carrera();
            $objSemestre = new Semestre();
            $objModelo = new Modelo();
            $sexo = ["Masculino", "Femenino"];
            echo '<table>';
            echo '<tr><td colspan="10">' . utf8_decode("Datos Básicos") . '</td></tr>';
            echo '<tr><td colspan="10"> </td></tr>';
            echo '<tr>';
            echo '<th>' . utf8_decode('Identificación') . '</th>';
            echo '<th>Apellidos</th>';
            echo '<th>Nombres</th>';
            echo '<th>Edad</th>';
            echo '<th>Genero</th>';
            echo '<th>' . utf8_decode('Nivel Acádemico') . '</th>';
            echo '<th>Carrera</th>';
            echo '<th>Semestre</th>';
            echo '<th>' . utf8_decode('Módelo') . '</th>';
            echo '<th>Fecha y Hora</th>';
            echo '</tr>';

            $resultado = $objAprendiz->consultarAprendiz($idAprendiz);
            $fila = $resultado->fetch(PDO::FETCH_ASSOC);
            $edad = CalculaEdad($fila["FechaNacimiento"]);
            echo "<tr>";
            echo "<td align='center'>" . $fila["Cedula"] . "</td><td>" . trim(utf8_decode($fila["Apellido1"]) . " " . utf8_decode($fila["Apellido2"])) . "</td><td>" . trim(utf8_decode($fila["Nombre1"]) . " " . utf8_decode($fila["Nombre2"])) . "</td>" . "<td>" . $edad . "</td>" . "<td>" . $sexo[$fila["Sexo"]-1] . "</td>";
            $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
            $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
            echo "<td>" . utf8_decode($nivel["Nombre"]) . "</td>";
            $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
            $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
            echo "<td>" . utf8_decode($carrera["Nombre"]) . "</td>";
            $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
            $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
            echo "<td>" . utf8_decode($semestre["Nombre"]) . "</td>";
            $resModelo = $objModelo->consultarModelo($fila["idModelo"]);
            $modelo = $resModelo->fetch(PDO::FETCH_ASSOC);
            echo "<td>" . utf8_decode($modelo["Nombre"]) . "</td>";
            echo "<td>" . utf8_decode($fila["FechaHora"]) . "</td>";
            echo "</tr>";
            echo '</table>';

            echo '<table>';
            echo '<tr><td colspan="10">' . utf8_decode("Resultados") . '</td></tr>';
            echo '<tr><td colspan="10"> </td></tr>';
            echo '<tr>';
            echo '<th>Fase</th>';
            echo '<th>Pregunta</th>';
            echo '<th>Acierto</th>';
            echo '<th>Tiempo</th>';
            echo '<th>Intento</th>';
            echo "</tr>";

            require "../modelo/Resultado.php";
            require "../modelo/Fase.php";
            require "../modelo/Pregunta.php";
            require "../modelo/Estimulo.php";
            //Creamos el objeto Resultado, Pregunta, Fase, Estimulo
            $objResultado = new Resultado();
            $objFase = new Fase();
            $objPregunta = new Pregunta();
            $objEstimulo = new Estimulo();
            $resResultado = $objResultado->consultaResultados($idAprendiz);
            $acierto = ["No", "Si"];
            $faseactual = "";
            $tiempo = 0;
            $tiempofase = 0;
            $preguntas = 0;
            $imprime = false;
            while ($fila = $resResultado->fetch(PDO::FETCH_ASSOC))
                {
                $resFase = $objFase->consultarFase($fila["idFase"]);
                $fase = $resFase->fetch(PDO::FETCH_ASSOC);
                if (empty($faseactual) == false){
                    if ($faseactual <> $fila["idFase"]){
                        if ($imprime == true) {
                            echo '<tr">';
                            echo '<td colspan="3" style="font-weight:bold;">TOTALES DEL INTENTO:</td>';
                            echo '<td style="font-weight:bold;">' . $tiempofase . '</td>';
                            echo '<td></td>';
                            echo "</tr>";
                        }
                        echo '<tr style="background: #ccc;">';
                        echo '<td colspan="3">TOTALES DE LA FASE:</td>';
                        echo '<td>' . $tiempo . '</td>';
                        echo '<td></td>';
                        echo "</tr>";
                        $faseactual = $fila["idFase"];
                        $tiempo = 0;
                        $preguntas = 0;
                        $tiempofase = 0;
                        $imprime = false;
                    } else {
                        if ($preguntas >= $fase["Numero_Preguntas"]) {
                            echo '<tr">';
                            echo '<td colspan="3" style="font-weight:bold;">TOTALES DEL INTENTO:</td>';
                            echo '<td style="font-weight:bold;">' . $tiempofase . '</td>';
                            echo '<td></td>';
                            echo "</tr>";
                            $preguntas = 0;
                            $tiempofase = 0;
                            $imprime = true;
                        }
                    }
                } else {
                    $faseactual = $fila["idFase"];
                }
                $tiempo = $tiempo + $fila["Tiempo"];
                $tiempofase = $tiempofase + $fila["Tiempo"];
                $preguntas = $preguntas + 1;
                echo "<tr>";
                echo "<td>" . utf8_decode($fase["Nombre"]) . "</td>";
                $resPregunta = $objPregunta->consultarPregunta($fila["idPregunta"]);
                $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                $resEstimulo = $objEstimulo->ConsultarEstimulo($pregunta["idMuestra"]);
                $estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . utf8_decode($estimulo["Palabra"]) . "</td>";
                echo "<td>" . $acierto[$fila["Acierto"]] . "</td>";
                echo "<td>" . $fila["Tiempo"] . "</td>";
                echo "<td>" . $fila["Intento"] . "</td>";
                echo "</tr>";
                }
            if (empty($tiempo) == false){
                echo '<tr style="background: #ccc;">';
                echo '<td colspan="3">TOTALES DE LA FASE:</td>';
                echo '<td>' . $tiempo . '</td>';
                echo '<td></td>';
                echo "</tr>";
            }

            echo '</table>';
        }
    }else{
        header ('location: login.php');
    }
?>