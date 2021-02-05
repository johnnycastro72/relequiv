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
                $optModelo = "";
                $optFase = "";
                if(isset($_GET["idModelo"])){
                    $idModelo = $_GET["idModelo"];
                } else {
                    $idModelo = 1;
                }
                if(isset($_GET["idFase"])){
                    $idFase = $_GET["idFase"];
                } else {
                    $idFase = 1;
                }
                require "../modelo/conectar.php";
                require "../modelo/Modelo.php";
                require "../modelo/Fase.php";
                //Creamos el objeto Modelo
                $objModelo = new Modelo();
                $resModelo = $objModelo->consultarModelos();
                while ($fila = $resModelo->fetch(PDO::FETCH_ASSOC))
                {
                    $optModelo .= '<OPTION';
                    if ($fila["idModelo"] == $idModelo){
                        $optModelo .= ' SELECTED';
                    }
                    $optModelo .= ' VALUE="' . $fila["idModelo"] . '">' . $fila["Nombre"];
                }
                //Creamos el objeto Fase
                $objFase = new Fase();
                $resFase = $objFase->consultarFases($idModelo);
                $esta=0;
                while ($fila = $resFase->fetch(PDO::FETCH_ASSOC))
                {
                    $optFase .= '<OPTION';
                    if ($fila["idFase"] == $idFase){
                        $optFase .= ' SELECTED';
                        $esta = $idFase;
                    } else {
                        if ($esta==0){
                            $esta = $fila["idFase"];
                        }
                    }
                    $optFase .= ' VALUE="' . $fila["idFase"] . '">' . $fila["Nombre"] . "</OPTION>";
                }
                if($esta <> $idFase){
                   $idFase = $esta;
                }
           ?>
           
           <h2>Menú de Preguntas</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <?php
                        echo '<li><a href="../controlador/pregadd.php?idFase=' . $idFase . '&idModelo=' . $idModelo . '">Agregar</a></li>'
                   ?>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span>Volver</a></li>
                   <li align="center"><h1>Seleccione el Módelo: </h1>
                       <SELECT id="sModelo" onchange="j2c()">
                        <?php
                            echo $optModelo;
                        ?>
                       </SELECT>
                    </li>
                   <li align="center"><h1>Seleccione la Fase: </h1>
                       <SELECT id="sFase" onchange="j2c()">
                       <?php
                            echo $optFase;
                       ?>
                       </SELECT>
                    </li>
               </ul>
           </nav>
            <script>
                function j2c() {
                    var oo = document.getElementById("sModelo");
                    var xx = oo.selectedIndex;
                    var yy = oo.options[xx].value;
                    var o = document.getElementById("sFase");
                    var x = o.selectedIndex;
                    var y = o.options[x].value;
                    var s = "../vista/pregunta-vista.php?idModelo=";
                    var ss = "&idFase=";
                    location.replace(s+yy+ss+y);
                }
            </script>
       </header>
        <section id="seccion">
            <?php   
                $dataFase = $objFase->consultarFase($idFase);
                $fase = $dataFase->fetch(PDO::FETCH_ASSOC);
                echo '<h3>Preguntas de ' . $fase['Nombre'] . '</h3>'
            ?>
            <table>
                <tr>
                    <?php
                    if ($fase["Diccionario"] == 0) {
                        echo '<th>Identificación</th>';
                        echo '<th>Tipo Muestra</th>';
                        if ($fase["TiempoEstimulo"] == 0) {
                            echo '<th>Tipo Estímulo</th>';
                        }
                        echo '<th>Muestra</th>';
                        echo '<th>Entrenamiento</th>';
                        echo '<th>Frase Muestra</th>';
                        if ($fase["TiempoEstimulo"] == 0) {
                            echo '<th>Frase Estímulo</th>';
                        }
                        echo '<th>Frase Final</th>';
                    } else {
                        echo '<th>Identificación</th>';
                        echo '<th>Frase Inicial</th>';
                        echo '<th>Frase Confirmación</th>';
                        echo '<th>Imagén</th>';
                    }
                    ?>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                    require "../modelo/Tipo.php";
                    $objTipo = new Tipo();
                    require "../modelo/Estimulo.php";
                    $objEstimulo = new Estimulo();
                    require "../modelo/Pregunta.php";
                    //Creamos el objeto Pregunta
                    $objPregunta = new Pregunta();
                    $resultado = $objPregunta->consultarPreguntas($idFase);
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        echo "<td align='center'>" . $fila["idPregunta"] . "</td>";
                        if ($fase["Diccionario"] == 0) {
                            $resTipo = $objTipo->consultarTipo($fila["idTipoMuestra"]);
                            $tipo = $resTipo->fetch(PDO::FETCH_ASSOC);
                            echo "<td>" . $tipo["Nombre"] . "</td>";
                            if ($fase["TiempoEstimulo"] == 0) {
                                $resTipo = $objTipo->consultarTipo($fila["idTipoEstimulo"]);
                                $tipo = $resTipo->fetch(PDO::FETCH_ASSOC);
                                echo "<td>" . $tipo["Nombre"] . "</td>";
                            }
                            $resEstimulo = $objEstimulo->consultarEstimulo($fila["idMuestra"]);
                            $estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC);
                            echo "<td>" . $estimulo["Palabra"] . "</td>";
                            echo "<td>" . '<input type="checkbox" name="Entrenamiento" value="Entrenamiento"';
                            if ($fila["Entrenamiento"]==1){
                                echo 'checked';
                            }
                            echo " disabled></td><td>" . $fila["FraseMuestra"] . "</td>";
                            if ($fase["TiempoEstimulo"] == 0) {
                                echo "<td>" . $fila["FraseEstimulo"] . "</td>";
                            }
                            echo "<td>" . $fila["FraseFinal"] . "</td>";
                        } else {
                            echo "<td>" . $fila["FraseMuestra"] . "</td>";
                            echo "<td>" . $fila["FraseEstimulo"] . "</td>";
                            echo "<td>" . '<img src="' . $fila["FraseFinal"] . '" alt="' . $fila["FraseFinal"] . '" width="250px" height="250px"/>' . "</td>";
                        }
                        echo '<td align="center"><a href="../controlador/pregedit.php?idPregunta=' . $fila["idPregunta"] . "&idModelo=" . $idModelo . "&idFase=" . $idFase . '" title="Clic para Modificar datos de la Pregunta">' . '<img src="../recursos/editar.png" width="30" height="30" /></a></td>' . '<td align="center"><a href="../controlador/pregdel.php?idPregunta=' . $fila["idPregunta"] . "&idModelo=" . $idModelo . "&idFase=" . $idFase . '" title="Clic para Eliminar la Pregunta">' . '<img src="../recursos/eliminar.png" width="30" height="30" /></a></td>';
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