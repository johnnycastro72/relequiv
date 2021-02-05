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
  
            <h2>Menú de Niveles Académicos</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/niveladd.php">Agregar</a></li>
                   <li><a href="../controlador/principal.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">
            <h3>Niveles Académicos</h3>
            <table>
                <tr>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                    require "../modelo/conectar.php";
                    require "../modelo/Nivel.php";
                    //Creamos el objeto Nivel
                    $objNivel = new Nivel();
                    $resultado = $objNivel->consultarNiveles();
                    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<tr>";
                        echo "<td align='center'>" . $fila["idNivel"] . "</td><td>" . $fila["Nombre"] . "</td>" . '<td align="center"><a href="../controlador/niveledit.php?idNivel=' . $fila["idNivel"] . '" title="Clic para Modificar datos del Nivel">' . '<img src="../recursos/editar.png" width="30" height="30" /></a></td>' . '<td align="center"><a href="../controlador/niveldel.php?idNivel=' . $fila["idNivel"] . '" title="Clic para Eliminar el Nivel">' . '<img src="../recursos/eliminar.png" width="30" height="30" /></a></td>';
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