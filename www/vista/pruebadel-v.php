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
  
            <h2>Eliminando Prueba</h2>

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
            require "../modelo/conectar.php";
            require "../modelo/Prueba.php";
            //Creamos el objeto Prueba
            if ($_REQUEST['idPrueba']<>0)
            {
                $objPrueba = new Prueba();
                $resultado = $objPrueba->consultarPrueba($_REQUEST['idPrueba']);
                $prueba = $resultado->fetch(PDO::FETCH_ASSOC);
            }
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/PrueValidarEliminar.php" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Prueba a Eliminar</h1>
	                </div>
                    <input type="hidden" name="idPrueba" value="<?php echo $prueba['idPrueba']?>">
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <input type="date" placeholder="Fecha de Aplicación de la prueba" name="Fecha" value="<?php echo $prueba['Fecha']?>" disabled>
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-earth"></label>
	                    <input type="text" placeholder="Ubicación donde se aplica la prueba" name="Ubicacion" value="<?php echo $prueba['Ubicacion']?>" disabled>
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-earth"></label>
	                    <input type="number" placeholder="Número de aprendices por módelo" name="Numero_Aprendiz"  value="<?php echo $prueba['Numero_Aprendiz']?>" disabled>
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Eliminado la Prueba Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Eliminar la Prueba, favor Revisar';
                        ?>            
                     </div>
	            
    	            <button type="submit">Eliminar Prueba <label class="lnr lnr-chevron-right"></label></button>
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