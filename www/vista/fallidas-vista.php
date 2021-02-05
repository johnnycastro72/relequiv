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

           <h2>Informes Pruebas Incompletas</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/falxls.php?idPrueba=<?php echo $idPrueba ?>"><span class="lnr lnr-download"></span> Exportar</a></li>
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
                var s = "../vista/fallidas-vista.php?idPrueba=";
                location.replace(s+y);
            }
        </script>
     </header>
        <section id="seccion">
            <h3>Sujetos Pruebas Incompletas</h3>
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
                    <th>Tiempo Total</th>
                    <th>Resultados</th>
                </tr>
                <?php
                    function CalculaEdad( $fecha ) {
                        list($Y,$m,$d) = explode("-",$fecha);
                        return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
                    }
                
                require "../modelo/Fallido.php";
                require "../modelo/Nivel.php";
                require "../modelo/Carrera.php";
                require "../modelo/Semestre.php";
                require "../modelo/Modelo.php";
                require "../modelo/Fallares.php";
                //Creamos el objeto Fallido, Nivel, Carrera, Semestre, Modelo, Fallares
                $objFallido = new Fallido();
                $objNivel = new Nivel();
                $objCarrera = new Carrera();
                $objSemestre = new Semestre();
                $objModelo = new Modelo();
                $objFallares = new Fallares();
                $sexo = ["Masculino", "Femenino"];
                $resultado = $objFallido->consultarAprendices($idPrueba);
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                {
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
                    $sumaTiempo = $objFallares->sumaTiempo($fila["idAprendiz"]);
                    echo "<td>" . $sumaTiempo . "</td>";
                    echo '<td align="center"><a href="../controlador/fallres.php?idAprendiz=' . $fila["idAprendiz"] . '&idPrueba='. $fila["idPrueba"] . '" title="Clic para ver los resultados">' . '<img src="../recursos/1630027.png" width="30" height="30" /></a></td>';
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