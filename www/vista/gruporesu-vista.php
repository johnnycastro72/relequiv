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
                $optPrueba = "";
                $optModelo = "";
                if(isset($_GET["idPrueba"])){
                    $idPrueba = $_GET["idPrueba"];
                } else {
                    $idPrueba = -1;
                }
                if(isset($_GET["idModelo"])){
                    $idModelo = $_GET["idModelo"];
                } else {
                    $idModelo = -1;
                }
                require "../modelo/conectar.php";
                require "../modelo/Prueba.php";
                require "../modelo/Modelo.php";
                //Creamos el objeto Prueba
                $objPrueba = new Prueba();
                $resPrueba = $objPrueba->consultarPruebas();
                $optPrueba = '<OPTION VALUE="-1">Seleccione..</OPTION>';
                while ($fila = $resPrueba->fetch(PDO::FETCH_ASSOC))
                {
                    $optPrueba .= '<OPTION';
                    if ($fila["idPrueba"] == $idPrueba){
                        $optPrueba .= ' SELECTED';
                    }
                    $optPrueba .= ' VALUE="' . $fila["idPrueba"] . '">' . $fila["Ubicacion"] . "</OPTION>";
                }
                $objModelo = new Modelo();
                $resModelo = $objModelo->consultarModelos();
                $esta = 0;
                while ($fila = $resModelo->fetch(PDO::FETCH_ASSOC))
                {
                    $optModelo .= '<OPTION';
                    if ($fila["idModelo"] == $idModelo){
                        $optModelo .= ' SELECTED';
                        $esta = $idModelo;
                    } else {
                        if ($esta == 0) {
                            $esta = $fila["idModelo"];
                        }
                    }
                    $optModelo .= ' VALUE="' . $fila["idModelo"] . '">' . $fila["Nombre"] . "</OPTION>";
                }
                if ($esta <> $idModelo) {
                    $idModelo = $esta;
                }
           ?>

           <h2>Resultados Grupales</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/gruresxls.php?idPrueba=<?php echo $idPrueba ?>&idModelo=<?php echo $idModelo ?>"><span class="lnr lnr-download"></span> Exportar</a></li>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span> Volver</a></li>
                   <li align="center"><h1>Seleccione la Prueba: </h1>
                       <SELECT id="sPrueba" onchange="j2c()">
                        <?php
                            echo $optPrueba;
                        ?>
                       </SELECT>
                    </li>
                   <li align="center"><h1>Seleccione el Módelo: </h1>
                       <SELECT id="sModelo" onchange="j2c()">
                        <?php
                            echo $optModelo;
                        ?>
                       </SELECT>
                    </li>
               </ul>
           </nav>
          <script>
            function j2c() {
                var oo = document.getElementById("sPrueba");
                var xx = oo.selectedIndex;
                var yy = oo.options[xx].value;
                var o = document.getElementById("sModelo");
                var x = o.selectedIndex;
                var y = o.options[x].value;
                var s = "../vista/gruporesu-vista.php?idPrueba=";
                var ss = "&idModelo=";
                location.replace(s+yy+ss+y);
            }
        </script>
     </header>
        <section id="seccion">
            <h3>Resultados</h3>
                <?php
                    function CalculaEdad( $fecha ) {
                        list($Y,$m,$d) = explode("-",$fecha);
                        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
                    }
                
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
                    echo "<th>Identificación</th>";
                    echo "<th>Apellidos</th>";
                    echo "<th>Nombres</th>";
                    echo "<th>Edad</th>";
                    echo "<th>Genero</th>";
                    echo "<th>Nivel Acádemico</th>";
                    echo "<th>Carrera</th>";
                    echo "<th>Semestre</th>";
                    echo "<th>Tiempo Evaluación</th>";
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
                        echo "<td align='center'>" . trim($fila["Apellido1"] . ' ' . $fila["Apellido2"]) . "</td>";
                        echo "<td align='center'>" . trim($fila["Nombre1"] . ' ' . $fila["Nombre2"]) . "</td>";
                        echo "<td>" . $edad . "</td>";
                        echo "<td>" . $sexo[$fila["Sexo"]-1] . "</td>";
                        $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
                        $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
                        echo "<td>" . $nivel["Nombre"] . "</td>";
                        $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
                        $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
                        echo "<td>" . $carrera["Nombre"] . "</td>";
                        $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
                        $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
                        echo "<td>" . $semestre["Nombre"] . "</td>";
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
                    If ($total <> 0) {
                        echo '<tr">';
                        echo '<td colspan="8" style="font-weight:bold; background: #ccc;">PROMEDIO :</td>';
                        echo '<td style="font-weight:bold; background: #ccc;">' . $tiempo/$total . '</td>';
                        echo '<td style="font-weight:bold; background: #ccc;">' . $aciertos/$total . '</td>';
                        echo '<td style="font-weight:bold; background: #ccc;">' . $errores/$total . '</td>';
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                ?>
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