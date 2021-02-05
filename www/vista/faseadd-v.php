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
            extract ($_REQUEST);
            if (!isset($_REQUEST['msj']))
               $msj=0;
            if (!isset($_REQUEST['idModelo'])) {
                $idModelo=0;
            } else {
                $idModelo=$_REQUEST['idModelo'];
            }
            ?>
  
            <h2>Agregando Fase</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/fase.php?idModelo=<?php echo $idModelo?>"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">
            <div class="container-form">
    	        <form action="../controlador/FaseValidarInsertar.php?idModelo=<?php echo $idModelo?>"  method="post" class="form">
    	            <div class="welcome-form">
                        <h4>Digite los datos de la Fase</h4>
	                </div>
                    <input type="hidden" name="idFase">
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Nombre de la Fase" name="Nombre" required>
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <h5>Evaluación: </h5><input type="checkbox" name="Evaluacion" value="1"> 
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Número de Preguntas" name="Numero_Preguntas" required>
	                </div>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
                        <h5>Acertividad:</h5><input type="checkbox" name="Acertividad" value="1">
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Muestra: </h5><input type="number" min="0" max="10" step="1" name="TiempoMuestra" value="0"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Estímulo: </h5><input type="number" min="0" max="10" step="1" name="TiempoEstimulo" value="0"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Tiempo Espera: </h5><input type="number" min="0" max="10" step="1" name="TiempoEspera" value="0"> 
                    </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
                        <h5>Diccionario:</h5><input type="checkbox" name="Diccionario" value="1">
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Agregado la Fase Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Agregar la Fase, favor Revisar';
                        if ($msj==3)
                            echo '<p align="center"> La Fase YA existe, favor Revisar';
                        ?>            
                     </div>
	            
    	            <button type="submit">Guardar Fase <label class="lnr lnr-chevron-right"></label></button>
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