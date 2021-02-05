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
            if (!isset($_REQUEST['idFase'])) {
                $idFase=0;
            } else {
                $idFase=$_REQUEST['idFase'];
            }
            if (!isset($_REQUEST['idModelo'])) {
                $idModelo=0;
            } else {
                $idModelo=$_REQUEST['idModelo'];
            }
            ?>
  
            <h2>Agregando Pregunta</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/pregunta.php?idFase=<?php echo $idFase?>&idModelo=<?php echo $idModelo?>"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">
            <div class="container-form">
    	        <form action="../controlador/PregValidarInsertar.php?idFase=<?php echo $idFase?>&idModelo=<?php echo $idModelo?>"  method="post" enctype="multipart/form-data" class="form">
    	            <div class="welcome-form">
                        <h4>Digite los datos de la Pregunta</h4>
	                </div>
                    <input type="hidden" name="idPregunta">

                    <?php
                    require "../modelo/conectar.php";
                    require "../modelo/Tipo.php";
                    require "../modelo/Estimulo.php";
                    require "../modelo/Fase.php";
                    // creamos los objetos Tipo, Estimulo y Fase.
                    $objTipo = new Tipo();
                    $resTipo = $objTipo->consultarTipos();
                    $optTipo = "";
                    while ($fila = $resTipo->fetch(PDO::FETCH_ASSOC))
                    {
                        $optTipo .= '<OPTION';
                        $optTipo .= ' VALUE="' . $fila["idTipoEstimulo"] . '">' . $fila["Nombre"];
                    }
                    $objEstimulo = new Estimulo();
                    $resEstimulo = $objEstimulo->consultarEstimulos();
                    $optEstimulo = "";
                    while ($fila2 = $resEstimulo->fetch(PDO::FETCH_ASSOC))
                    {
                        $optEstimulo .= '<OPTION';
                        $optEstimulo .= ' VALUE="' . $fila2["idEstimulo"] . '">' . $fila2["Palabra"];
                    }
                    ?>
                    <?php
                    $objFase = new Fase();
                    $resFase = $objFase->consultarFase($idFase);
                    $fase    = $resFase->fetch(PDO::FETCH_ASSOC);
                    if ($fase["Diccionario"] == 0){
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-select"></label>';
                        echo '<h5>Tipo de Muestra: </h5><select id="idTipoMuestra" name="idTipoMuestra">';
                        echo $optTipo;
                        echo '</select>';
                        echo '</div>';

                        if ($fase["TiempoEstimulo"] == 0){
                            echo '<div class="line-input">';
                            echo '<label class="lnr lnr-select"></label>';
                            echo '<h5>Tipo de Estímulo: </h5><select id="idTipoEstimulo" name="idTipoEstimulo">';
                            echo $optTipo;
                            echo '</select>';
                            echo '</div>';
                        }
                    
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-select"></label>';
                        echo '<h5>Muestra: </h5><select id="idMuestra" name="idMuestra">';
                        echo $optEstimulo;
                        echo '</select>';
                        echo '</div>';

                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<h5>Entrenamiento: </h5><input type="checkbox" name="Entrenamiento" value="1">';
                        echo '</div>';
         
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<input type="text" placeholder="Frase Muestra:" name="FraseMuestra" value="">';
                        echo '</div>';

                        if ($fase["TiempoEstimulo"] == 0){
                            echo '<div class="line-input">';
                            echo '<label class="lnr lnr-keyboard"></label>';
                            echo '<input type="text" placeholder="Frase Estímulo" name="FraseEstimulo" value="">';
                            echo '</div>';
                        }
	                     
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<input type="text" placeholder="Frase Final:" name="FraseFinal" value="">';
                        echo '</div>';

                    } else {
                        
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<input type="text" placeholder="Frase Inicial:" name="FraseMuestra" value="">';
                        echo '</div>';

                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<input type="text" placeholder="Frase Confirmación" name="FraseEstimulo" value="">';
                        echo '</div>';
	                     
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-camera"></label>';
                        echo '<input type="file" accept="image/jpeg,image/gif,image/png,image/x-eps" placeholder="Imagén" name="FraseFinal" required>';
                        echo '</div>';

                    }
                    ?>

                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Agregado la Pregunta Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Agregar la Pregunta, favor Revisar';
                        if ($msj==3)
                            echo '<p align="center"> La Pregunta YA existe, favor Revisar';
                        ?>            
                    </div>
	            
    	            <button type="submit">Guardar Pregunta <label class="lnr lnr-chevron-right"></label></button>
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