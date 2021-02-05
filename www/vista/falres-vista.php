<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style3.css">
	</head>
	<body>
       <header>
  
           <?php
                if(isset($_GET["idAprendiz"])){
                    $idAprendiz = $_GET["idAprendiz"];
                } else {
                    $idAprendiz = 1;
                }
                if(isset($_GET["idPrueba"])){
                    $idPrueba = $_GET["idPrueba"];
                } else {
                    $idPrueba = -1;
                }
           ?>

           <h2>Resultados Incompletos Individuales</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/frexls.php?idAprendiz=<?php echo $idAprendiz ?>"><span class="lnr lnr-download"></span> Exportar</a></li>
                   <li><a href="../vista/fallidas-vista.php?idPrueba=<?php echo $idPrueba ?>"><span class="lnr lnr-exit"></span> Volver</a></li>
               </ul>
           </nav>
     </header>
        <section id="seccion">
            <h3>Datos Básicos</h3>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Edad</th>
                    <th>Genero</th>
                    <th>Nivel Acádemico</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Módelo</th>
                    <th>Fecha y Hora</th>
                </tr>
                <?php
                    function CalculaEdad( $fecha ) {
                        list($Y,$m,$d) = explode("-",$fecha);
                        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
                    }
                
                require "../modelo/conectar.php";
                require "../modelo/Fallido.php";
                require "../modelo/Nivel.php";
                require "../modelo/Carrera.php";
                require "../modelo/Semestre.php";
                require "../modelo/Modelo.php";
                //Creamos el objeto Fallido, Nivel, Carrera, Semestre, Modelo
                $objFallido = new Fallido();
                $objNivel = new Nivel();
                $objCarrera = new Carrera();
                $objSemestre = new Semestre();
                $objModelo = new Modelo();
                $sexo = ["Masculino", "Femenino"];
                $resFallido = $objFallido->consultarAprendiz($idAprendiz);
                $fila = $resFallido->fetch(PDO::FETCH_ASSOC);
                $edad = CalculaEdad($fila["FechaNacimiento"]);
                echo "<tr>";
                echo "<td align='center'>" . $fila["Cedula"] . "</td><td>" . trim($fila["Apellido1"] . " " . $fila["Apellido2"]) . "</td><td>" . trim($fila["Nombre1"] . " " . $fila["Nombre2"]) . "</td>" . "<td>" . $edad . "</td>" . "<td>" . $sexo[$fila["Sexo"]-1] . "</td>";
                $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
                $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . $nivel["Nombre"] . "</td>";
                $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
                $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . $carrera["Nombre"] . "</td>";
                $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
                $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . $semestre["Nombre"] . "</td>";
                $resModelo = $objModelo->consultarModelo($fila["idModelo"]);
                $modelo = $resModelo->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . $modelo["Nombre"] . "</td>";
                echo "<td>" . $fila["FechaHora"] . "</td>";
                echo "</tr>";
                ?>
            </table>

            <h3>Resultados Incompletos</h3>
            <table>
                <tr>
                    <th>Fase</th>
                    <th>Pregunta</th>
                    <th>Acierto</th>
                    <th>Tiempo</th>
                    <th>Intento</th>
                </tr>
                <?php
                require "../modelo/Fallares.php";
                require "../modelo/Fase.php";
                require "../modelo/Pregunta.php";
                require "../modelo/Estimulo.php";
                //Creamos el objeto Fallres, Pregunta, Fase, Estimulo
                $objFallares = new Fallares();
                $objFase = new Fase();
                $objPregunta = new Pregunta();
                $objEstimulo = new Estimulo();
                $resFallares = $objFallares->consultaResultados($idAprendiz);
                $acierto = ["No", "Si"];
                $faseactual = "";
                $tiempo = 0;
                $tiempofase = 0;
                $preguntas = 0;
                $imprime = false;
                while ($fila = $resFallares->fetch(PDO::FETCH_ASSOC))
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
                    echo "<td>" . $fase["Nombre"] . "</td>";
                    $resPregunta = $objPregunta->consultarPregunta($fila["idPregunta"]);
                    $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                    $resEstimulo = $objEstimulo->ConsultarEstimulo($pregunta["idMuestra"]);
                    $estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC);
                    echo "<td>" . $estimulo["Palabra"] . "</td>";
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
                ?>
            </table>
        </section>
       <aside id="lateral">
       </aside>
       <footer class="pie">
            <div id="pieizq">
            </div>
            <div id="piecentro">
            </div>
            <div id="pieder">
            </div>
        </footer>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/menu.js"></script>
	</body>
</html>