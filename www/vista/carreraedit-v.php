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
  
            <h2>Modificando Carrera</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/carrera.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">

            <?php
            extract ($_REQUEST);
            require "../modelo/conectar.php";
            require "../modelo/Carrera.php";
            //Creamos el objeto Carrera
            if ($_REQUEST['idCarrera']<>0)
            {
                $objCarrera = new Carrera();
                $resultado = $objCarrera->consultarCarrera($_REQUEST['idCarrera']);
                $carrera = $resultado->fetch(PDO::FETCH_ASSOC);
            }
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/CarrValidarEditar.php" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Carrera a Modificar</h1>
	                </div>
                    <input type="hidden" name="idCarrera" value="<?php echo $carrera['idCarrera']?>">
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Nombre de la Carrera" name="Nombre" value="<?php echo $carrera['Nombre']?>" required>
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Modificado la Carrera Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Modificar la Carrera, favor Revisar';
                        ?>            
                     </div>
	            
    	            <button type="submit">Guardar Cambios <label class="lnr lnr-chevron-right"></label></button>
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