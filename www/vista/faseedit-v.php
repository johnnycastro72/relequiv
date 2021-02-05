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
  
            <h2>Modificando Fase</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <?php
                        if(isset($_GET["idModelo"])){
                            $idModelo = $_GET["idModelo"];
                        } else {
                            $idModelo = 1;
                        }
                   ?>
                   <li><a href="../controlador/fase.php?idModelo=<?php echo $idModelo?>"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">

            <?php
            extract ($_REQUEST);
            require "../modelo/conectar.php";
            require "../modelo/Fase.php";
            //Creamos el objeto Fase
            if ($_REQUEST['idFase']<>0)
            {
                $objFase = new Fase();
                $resultado = $objFase->consultarFase($_REQUEST['idFase']);
                $fase = $resultado->fetch(PDO::FETCH_ASSOC);
            }
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/FaseValidarEditar.php?idModelo=<?php echo $idModelo?>" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Fase a Modificar</h1>
	                </div>
                    <input type="hidden" name="idFase" value="<?php echo $fase['idFase']?>">
                    <input type="hidden" name="idModelo" value="<?php echo $fase['idModelo']?>">
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Nombre de la Fase" name="Nombre" value="<?php echo $fase['Nombre']?>" required>
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <h5>Evaluación: </h5><input type="checkbox" name="Evaluacion" value="1" <?php echo ($fase['Evaluacion']==1 ? 'checked' : '');?> >
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Número de Preguntas" name="Numero_Preguntas" value="<?php echo $fase['Numero_Preguntas']?>" required>
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
                        <h5>Acertividad:</h5><input type="checkbox" name="Acertividad" value="1" <?php echo ($fase['Acertividad']==1 ? 'checked' : '');?> >
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Muestra: </h5><input type="number" min="0" max="10" step="1" name="TiempoMuestra" value="<?php echo $fase['TiempoMuestra']?>"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Estímulo: </h5><input type="number" min="0" max="10" step="1" name="TiempoEstimulo" value="<?php echo $fase['TiempoEstimulo']?>"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Espera: </h5><input type="number" min="0" max="10" step="1" name="TiempoEspera" value="<?php echo $fase['TiempoEspera']?>"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
                        <h5>Diccionario:</h5><input type="checkbox" name="Diccionario" value="1" <?php echo ($fase['Diccionario']==1 ? 'checked' : '');?> >
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Modificado la Fase Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Modificar la Fase, favor Revisar';
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