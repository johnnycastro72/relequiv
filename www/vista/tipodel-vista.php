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
  
            <h2>Eliminando Tipo de Estímulo</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/tipo.php"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">

            <?php
            extract ($_REQUEST);
            require "../modelo/conectar.php";
            require "../modelo/Tipo.php";
            //Creamos el objeto Tipo
            if ($_REQUEST['idTipo']<>0)
            {
                $objTipo = new Tipo();
                $resultado = $objTipo->consultarTipo($_REQUEST['idTipo']);
                $tipo = $resultado->fetch(PDO::FETCH_ASSOC);
            }
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/TipoValidarEliminar.php" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Tipo de Estímulo a Eliminar</h1>
	                </div>
                    <input type="hidden" name="idTipoEstimulo" value="<?php echo $tipo['idTipoEstimulo']?>">
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Nombre de Tipo de Estímulo" name="Nombre" value="<?php echo $tipo['Nombre']?>" disabled>
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Eliminado el Tipo de Estímulo Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Eliminar el Tipo de Estímulo, favor Revisar';
                        ?>            
                     </div>
	            
    	            <button type="submit">Eliminar Tipo de Estímulo <label class="lnr lnr-chevron-right"></label></button>
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