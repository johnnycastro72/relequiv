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
  
            <h2>Agregando Prueba</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/prueba.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">

            <?php
            extract ($_REQUEST);
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/PrueValidarInsertar.php" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Digite los datos de la Prueba</h1>
	                </div>
                    <input type="hidden" name="idPrueba">
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <input type="date" placeholder="Fecha de Aplicación de la prueba" name="Fecha" required>
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-earth"></label>
	                    <input type="text" placeholder="Ubicación donde se aplica la prueba" name="Ubicacion" required>
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-earth"></label>
	                    <input type="number" placeholder="Número de aprendices por módelo" name="Numero_Aprendiz" required>
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Agregado la Prueba Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Agregar la Prueba, favor Revisar';
                        ?>            
                     </div>
	            
    	            <button type="submit">Guardar Prueba <label class="lnr lnr-chevron-right"></label></button>
	            </form>
    		</div>
    
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