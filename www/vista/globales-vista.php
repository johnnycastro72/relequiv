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
                if(isset($_GET["idPrueba"])){
                    $idPrueba = $_GET["idPrueba"];
                } else {
                    $idPrueba = -1;
                }
           ?>

           <h2>Informes Globales</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/glbxls.php?idPrueba=<?php echo $idPrueba ?>"><span class="lnr lnr-download"></span> Exportar</a></li>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span> Volver</a></li>
                   <li align="center"><h1>Seleccione la Prueba: </h1>
                       <SELECT id="sPrueba" onchange="j2c()">
                        <?php
                        require "../modelo/conectar.php";
                        require "../modelo/Prueba.php";
                        //Creamos el objeto Prueba
                        $objPrueba = new Prueba();
                        $resultado = $objPrueba->consultarPruebas();
                        echo '<OPTION VALUE="-1">Seleccione..</OPTION>';
                        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<OPTION';
                            if ($fila["idPrueba"] == $idPrueba){
                                echo ' SELECTED';
                            }
                            echo ' VALUE="' . $fila["idPrueba"] . '">' . $fila["Ubicacion"] . '</OPTION>';
                        }?>
                       </SELECT>
                    </li>
               </ul>
           </nav>
          <script>
            function j2c() {
                var o = document.getElementById("sPrueba");
                var x = o.selectedIndex;
                var y = o.options[x].value;
                var s = "../vista/globales-vista.php?idPrueba=";
                location.replace(s+y);
            }
        </script>
     </header>
        <section id="seccion">
            <h3>Datos Demográficos</h3>
                <?php
                require "../modelo/Aprendiz.php";
                require "../modelo/Nivel.php";
                require "../modelo/Carrera.php";
                require "../modelo/Semestre.php";
                //Creamos el objeto Aprendiz, Nivel, Carrera, Semestre
                $objAprendiz = new Aprendiz();
                $objNivel = new Nivel();
                $objCarrera = new Carrera();
                $objSemestre = new Semestre();
                if ($idPrueba <> -1) {
                    echo "<table>";
                    echo "<caption>Pruebas por Edad</caption>";
                    echo "<tr>";
                    echo "<th>Edad</th>";
                    echo "<th>Frecuencia</th>";
                    echo "<th>Porcentaje</th>";
                    echo "</tr>";
                    $total = $objAprendiz->contarAprendiz($idPrueba);
                    $resultado = $objAprendiz->demograficoEdad($idPrueba);
                    $frecuencia = 0;
                    $percentil = 0;
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        echo "<td align='center'>" . $fila["Edad"] . "</td>";
                        echo "<td align='center'>" . $fila["Frecuencia"] . "</td>";
                        echo "<td align='center'>" . round((($fila["Frecuencia"]/$total)*100),2) . "</td>";
                        echo "</tr>";
                        $frecuencia = $frecuencia + $fila["Frecuencia"];
                        $percentil = $percentil + (($fila["Frecuencia"]/$total)*100);
                    }
                    echo '<tr">';
                    echo '<td style="font-weight:bold; background: #ccc;">TOTALES :</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . $frecuencia . '</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . round($percentil,2) . '</td>';
                    echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<caption>Pruebas por Genero</caption>";
                    echo "<tr>";
                    echo "<th>Genero</th>";
                    echo "<th>Frecuencia</th>";
                    echo "<th>Porcentaje</th>";
                    echo "</tr>";
                    $resultado = $objAprendiz->demograficoGenero($idPrueba);
                    $frecuencia = 0;
                    $percentil = 0;
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        if ($fila["Sexo"] == 1) {
                            echo "<td align='center'>Masculino</td>";
                        } else {
                            echo "<td align='center'>Femenino</td>";
                        }
                        echo "<td align='center'>" . $fila["Frecuencia"] . "</td>";
                        echo "<td align='center'>" . round((($fila["Frecuencia"]/$total)*100),2) . "</td>";
                        echo "</tr>";
                        $frecuencia = $frecuencia + $fila["Frecuencia"];
                        $percentil = $percentil + (($fila["Frecuencia"]/$total)*100);
                    }
                    echo '<tr">';
                    echo '<td style="font-weight:bold; background: #ccc;">TOTALES :</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . $frecuencia . '</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . round($percentil,2) . '</td>';
                    echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<caption>Pruebas por Nivel Acádemico</caption>";
                    echo "<tr>";
                    echo "<th>Nivel</th>";
                    echo "<th>Frecuencia</th>";
                    echo "<th>Porcentaje</th>";
                    echo "</tr>";
                    $resultado = $objAprendiz->demograficoNivel($idPrueba);
                    $frecuencia = 0;
                    $percentil = 0;
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
                        $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
                        echo "<td align='center'>" . $nivel["Nombre"] . "</td>";
                        echo "<td align='center'>" . $fila["Frecuencia"] . "</td>";
                        echo "<td align='center'>" . round((($fila["Frecuencia"]/$total)*100),2) . "</td>";
                        echo "</tr>";
                        $frecuencia = $frecuencia + $fila["Frecuencia"];
                        $percentil = $percentil + (($fila["Frecuencia"]/$total)*100);
                    }
                    echo '<tr">';
                    echo '<td style="font-weight:bold; background: #ccc;">TOTALES :</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . $frecuencia . '</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . round($percentil,2) . '</td>';
                    echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<caption>Pruebas por Carrera</caption>";
                    echo "<tr>";
                    echo "<th>Carrera</th>";
                    echo "<th>Frecuencia</th>";
                    echo "<th>Porcentaje</th>";
                    echo "</tr>";
                    $resultado = $objAprendiz->demograficoCarrera($idPrueba);
                    $frecuencia = 0;
                    $percentil = 0;
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
                        $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
                        echo "<td align='center'>" . $carrera["Nombre"] . "</td>";
                        echo "<td align='center'>" . $fila["Frecuencia"] . "</td>";
                        echo "<td align='center'>" . round((($fila["Frecuencia"]/$total)*100),2) . "</td>";
                        echo "</tr>";
                        $frecuencia = $frecuencia + $fila["Frecuencia"];
                        $percentil = $percentil + (($fila["Frecuencia"]/$total)*100);
                    }
                    echo '<tr">';
                    echo '<td style="font-weight:bold; background: #ccc;">TOTALES :</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . $frecuencia . '</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . round($percentil,2) . '</td>';
                    echo "</tr>";
                    echo "</table>";

                    echo "<table>";
                    echo "<caption>Pruebas por Semestre</caption>";
                    echo "<tr>";
                    echo "<th>Semestre</th>";
                    echo "<th>Frecuencia</th>";
                    echo "<th>Porcentaje</th>";
                    echo "</tr>";
                    $resultado = $objAprendiz->demograficoSemestre($idPrueba);
                    $frecuencia = 0;
                    $percentil = 0;
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
                        $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
                        echo "<td align='center'>" . $semestre["Nombre"] . "</td>";
                        echo "<td align='center'>" . $fila["Frecuencia"] . "</td>";
                        echo "<td align='center'>" . round((($fila["Frecuencia"]/$total)*100),2) . "</td>";
                        echo "</tr>";
                        $frecuencia = $frecuencia + $fila["Frecuencia"];
                        $percentil = $percentil + (($fila["Frecuencia"]/$total)*100);
                    }
                    echo '<tr">';
                    echo '<td style="font-weight:bold; background: #ccc;">TOTALES :</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . $frecuencia . '</td>';
                    echo '<td style="font-weight:bold; background: #ccc;">' . round($percentil,2) . '</td>';
                    echo "</tr>";
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