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
  
            <h2>Modificando Pregunta</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/pregunta.php?idFase=<?php echo $idFase?>&idModelo=<?php echo $idModelo?>"><span class="lnr lnr-exit"></span>Volver</a></li>
               </ul>
           </nav>
       </header>
        <section id="seccion">

            <?php
            extract ($_REQUEST);
            require "../modelo/conectar.php";
            require "../modelo/Pregunta.php";
            require "../modelo/Tipo.php";
            require "../modelo/Estimulo.php";
            require "../modelo/Fase.php";
            //Creamos el objeto Pregunta, Tipo, Estimulo y Fase.
            if ($_REQUEST['idPregunta']<>0)
            {
                $objPregunta = new Pregunta();
                $resultado = $objPregunta->consultarPregunta($_REQUEST['idPregunta']);
                $pregunta = $resultado->fetch(PDO::FETCH_ASSOC);
            }
            if (!isset($_REQUEST['msj']))
               $msj=0;
            ?>

            <div class="container-form">
    	        <form action="../controlador/PregValidarEditar.php?idFase=<?php echo $idFase?>&idModelo=<?php echo $idModelo?>" method="post" class="form">
    	            <div class="welcome-form">
                        <h1>Pregunta a Modificar</h1>
	                </div>
                    <input type="hidden" name="idFase" value="<?php echo $pregunta['idFase']?>">
                    <input type="hidden" name="idPregunta" value="<?php echo $pregunta['idPregunta']?>">
                    <?php
                    $objTipo = new Tipo();
                    $resTipo = $objTipo->consultarTipos();
                    $optTipo1 = "";
                    $optTipo2 = "";
                    while ($fila = $resTipo->fetch(PDO::FETCH_ASSOC))
                    {
                        $optTipo1 .= '<OPTION';
                        $optTipo2 .= '<OPTION';
                        $optTipo1 .= ' VALUE="' . $fila["idTipoEstimulo"];
                        $optTipo2 .= ' VALUE="' . $fila["idTipoEstimulo"];
                        if ($fila["idTipoEstimulo"] == $pregunta["idTipoMuestra"]){
                            $optTipo1 .= '" selected>' . $fila["Nombre"];
                        } else {
                            $optTipo1 .= '">' . $fila["Nombre"];
                        }
                        if ($fila["idTipoEstimulo"] == $pregunta["idTipoEstimulo"]){
                            $optTipo2 .= '" selected>' . $fila["Nombre"];
                        } else {
                            $optTipo2 .= '">' . $fila["Nombre"];
                        }
                    }
                    $objEstimulo = new Estimulo();
                    $resEstimulo = $objEstimulo->consultarEstimulos();
                    $optEstimulo = "";
                    while ($fila2 = $resEstimulo->fetch(PDO::FETCH_ASSOC))
                    {
                        $optEstimulo .= '<OPTION';
                        $optEstimulo .= ' VALUE="' . $fila2["idEstimulo"];
                        if ($fila2["idEstimulo"] == $pregunta["idMuestra"]){
                            $optEstimulo .= '" selected>' . $fila2["Palabra"];
                        } else {
                            $optEstimulo .= '">' . $fila2["Palabra"];
                        }
                    }
                    $objFase = new Fase();
                    $resFase = $objFase->consultarFase($idFase);
                    $fase    = $resFase->fetch(PDO::FETCH_ASSOC);
                    if ($fase["Diccionario"] == 0){
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-select"></label>';    
                        echo '<h5>Tipo de Muestra: </h5><select id="idTipoMuestra" name="idTipoMuestra">';
                        echo $optTipo1;
                        echo '</select>';
                        echo '</div>';

                        if ($fase["TiempoEstimulo"] == 0){
                            echo '<div class="line-input">';
                            echo '<label class="lnr lnr-select"></label>';
                            echo '<h5>Tipo de Estímulo: </h5><select id="idTipoEstimulo" name="idTipoEstimulo">';
                            echo $optTipo2;
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
	                    echo '<h5>Entrenamiento:</h5><input type="checkbox" name="Entrenamiento" value="1"';
                        echo ($pregunta['Entrenamiento']==1 ? 'checked>' : '>');
                        echo '</div>';

                        echo '<div class="line-input">';
	                    echo '<label class="lnr lnr-keyboard"></label>';
	                    echo '<input type="text" placeholder="Frase Muestra:" name="FraseMuestra" value="' . $pregunta['FraseMuestra'] . '">';
                        echo '</div>';

                        if ($fase["TiempoEstimulo"] == 0){
                            echo '<div class="line-input">';
                            echo '<label class="lnr lnr-keyboard"></label>';
                            echo '<input type="text" placeholder="Frase Estímulo" name="FraseEstimulo" value="' . $pregunta['FraseEstimulo'] . '">';
                            echo '</div>';
                        }

                        echo '<div class="line-input">';
	                    echo '<label class="lnr lnr-keyboard"></label>';
	                    echo '<input type="text" placeholder="Frase Final"name="FraseFinal" value="' .  $pregunta['FraseFinal'] . '">';
                        echo '</div>';
                    } else {

                        echo '<div class="line-input">';
	                    echo '<label class="lnr lnr-keyboard"></label>';
	                    echo '<input type="text" placeholder="Frase Inicial:" name="FraseMuestra" value="' . $pregunta['FraseMuestra'] . '">';
                        echo '</div>';
                        
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-keyboard"></label>';
                        echo '<input type="text" placeholder="Frase Confirmación" name="FraseEstimulo" value="' . $pregunta['FraseEstimulo'] . '">';
                        echo '</div>';
                        
                        echo '<div class="line-input">';
                        echo '<label class="lnr lnr-camera"></label>';
                        echo '<input type="text" placeholder="Imagén" name="FraseFinal" value="' . $pregunta["FraseFinal"] . '" readonly="readonly">';
                        echo '<img src="' . $pregunta["FraseFinal"] . '"' . '" width="40px" height="40px"/>';
                        echo '</div>';
                    }?>

                    <div class="mensaje">
                        <?php
                        if ($msj==1)
                            echo '<p align="center" >Se ha Modificado la Pregunta Correctamente';
                        if ($msj==2)
                            echo '<p align="center"> Problemas al Modificar la Pregunta, favor Revisar';
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