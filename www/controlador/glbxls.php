<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPrueba"])){
            $idPrueba = $_GET["idPrueba"];
            header ('Content-type:application/xls; charset=UTF-8');
            header ('Content-Disposition: attachment; filename=blgxls' . $idPrueba . '.xls');

            require "../modelo/conectar.php";
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
                echo "<caption>" . utf8_decode("Pruebas por Nivel Acádemico") . "</caption>";
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
                    echo "<td align='center'>" . utf8_decode($nivel["Nombre"]) . "</td>";
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
                    echo "<td align='center'>" . utf8_decode($carrera["Nombre"]) . "</td>";
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
                    echo "<td align='center'>" . utf8_decode($semestre["Nombre"]) . "</td>";
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
        }
    } else {
        header ('location: login.php');
    }
?>