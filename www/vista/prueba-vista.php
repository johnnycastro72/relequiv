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
  
            <h2>Menú de Pruebas</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/pruebaadd.php">Agregar</a></li>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">
            <h3>Pruebas</h3>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th>Número de Aprendices por Módelo</th>
                    <th>Creado Por</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                    require "../modelo/conectar.php";
                    require "../modelo/Prueba.php";
                    require "../modelo/Usuario.php";
                    $objUsuario = new User();
                    //Creamos el objeto Prueba
                    $objPrueba = new Prueba();
                    $resultado = $objPrueba->consultarPruebas();
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        $resUsuario = $objUsuario->consultarUser($fila["idUsuario"]);
                        $usuario = $resUsuario->fetch(PDO::FETCH_ASSOC);
                        echo "<tr>";
                        echo "<td align='center'>" . $fila["idPrueba"] . "</td><td>" . $fila["Fecha"] . "</td><td>" . $fila["Ubicacion"] . "</td><td>" . $fila["Numero_Aprendiz"] . "</td><td>" . $usuario["Nombre"] . "</td>" . '<td align="center"><a href="../controlador/pruebadel.php?idPrueba=' . $fila["idPrueba"] . '" title="Clic para Eliminar la Prueba">' . '<img src="../recursos/eliminar.png" width="30" height="30" /></a></td>';
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