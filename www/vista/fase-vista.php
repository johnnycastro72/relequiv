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
                if(isset($_GET["idModelo"])){
                    $idModelo = $_GET["idModelo"];
                } else {
                    $idModelo = 1;
                }
           ?>
           
            <h2>Menú de Fases</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <?php
                        echo '<li><a href="../controlador/faseadd.php?idModelo='.$idModelo.'">Agregar</a></li>'
                   ?>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span>Volver</a></li>
                   <li align="center"><h1>Seleccione el Módelo: </h1>
                       <SELECT id="sModelo" onchange="j2c()">
                        <?php
                        require "../modelo/conectar.php";
                        require "../modelo/Modelo.php";
                        //Creamos el objeto Modelo
                        $objModelo = new Modelo();
                        $resultado = $objModelo->consultarModelos();
                        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                        {
                            echo '<OPTION';
                            if ($fila["idModelo"] == $idModelo){
                                echo ' SELECTED';
                            }
                            echo ' VALUE="' . $fila["idModelo"] . '">' . $fila["Nombre"];
                        }?>
                       </SELECT>
                    </li>
               </ul>
           </nav>
            <script>
                function j2c() {
                    var o = document.getElementById("sModelo");
                    var x = o.selectedIndex;
                    var y = o.options[x].value;
                    var s = "../vista/fase-vista.php?idModelo=";
                    location.replace(s+y);
                }
            </script>
       </header>
        <section id="seccion">
            <?php   
                $dataModelo = $objModelo->consultarModelo($idModelo);
                $modelo = $dataModelo->fetch(PDO::FETCH_ASSOC);
                echo '<h3>Fases de ' . $modelo['Nombre'] . '</h3>'
            ?>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Evaluación</th>
                    <th>Preguntas</th>
                    <th>Acertividad</th>
                    <th>Tiempo Muestra</th>
                    <th>Tiempo Estímulo</th>
                    <th>Tiempo Espera</th>
                    <th>Diccionario</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                    require "../modelo/Fase.php";
                    //Creamos el objeto Fase
                    $objFase = new Fase();
                    $resultado = $objFase->consultarFases($idModelo);
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        echo "<td align='center'>" . $fila["idFase"] . "</td><td>" . $fila["Nombre"] . "</td><td>" . '<input type="checkbox" name="Evaluacion" value="Evaluacion" ';
                        if ($fila["Evaluacion"]==1){
                            echo 'checked';
                        }
                        echo " disabled></td><td>" . $fila["Numero_Preguntas"] . "</td><td>" . '<input type="checkbox" name="Acertividad" value="Acertividad" ';
                        if ($fila["Acertividad"]==1){
                            echo 'checked';
                        }
                        echo " disabled></td><td>" . $fila["TiempoMuestra"] . "</td><td>" . $fila["TiempoEstimulo"] . "</td><td>" . $fila["TiempoEspera"] . '</td><td>';
                        echo '<input type="checkbox" name="Diccionario" value="Diccionario" ';
                        if ($fila["Diccionario"]==1){
                            echo 'checked';
                        }
                        echo ' disabled></td><td align="center"><a href="../controlador/faseedit.php?idFase=' . $fila["idFase"] . '&idModelo=' . $fila["idModelo"] . '" title="Clic para Modificar datos de la Fase">' . '<img src="../recursos/editar.png" width="30" height="30" /></a></td>' . '<td align="center"><a href="../controlador/fasedel.php?idFase=' . $fila["idFase"] . '&idModelo=' . $fila["idModelo"] . '" title="Clic para Eliminar la Fase">' . '<img src="../recursos/eliminar.png" width="30" height="30" /></a></td>';
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