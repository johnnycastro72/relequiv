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
  
            <h2>Menú de Estímulos</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/estimuloadd.php">Agregar</a></li>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">
            <h3>Estímulos</h3>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Palabra</th>
                    <th>Imagen</th>
                    <th>Kanji</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                require "../modelo/conectar.php";
                require "../modelo/Estimulo.php";
                //Creamos el objeto Estimulo
                $objEstimulo = new Estimulo();
                $resultado = $objEstimulo->consultarEstimulos();
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        echo "<td>" . $fila["idEstimulo"] . "</td><td>" . $fila["Palabra"] . "</td><td>" . '<img src="' . $fila["Imagen"] . '" alt="' . $fila["Palabra"] . '" width="40px" height="40px"/>' . "</td><td>" . '<img src="' . $fila["Kanji"] . '" alt="' . $fila["Palabra"] . '" width="40px" height="40px"/>' . "</td>" . '<td align="center"><a href="../controlador/estimuloedit.php?idEstimulo=' . $fila["idEstimulo"] . '" title="Clic para Modificar datos del Estimulo">' . '<img src="../recursos/editar.png" width="30" height="30" /></a></td>' . '<td align="center"><a href="../controlador/estimulodel.php?idEstimulo=' . $fila["idEstimulo"] . '" title="Clic para Eliminar el Estimulo">' . '<img src="../recursos/eliminar.png" width="30" height="30" /></a></td>';
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