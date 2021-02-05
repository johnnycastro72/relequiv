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
  
            <h2>Agregando Estímulo</h2>

           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                   <li><a href="../controlador/estimulo.php"><span class="lnr lnr-exit"></span>Volver</a></li>
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
    	        <form action="../controlador/EstiValidarInsertar.php" method="post" enctype="multipart/form-data" class="form">
    	            <div class="welcome-form">
                        <h1>Digite los datos del Estímulo</h1>
	                </div>
                    <input type="hidden" name="idEstimulo">
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Palabra" name="Palabra" required>
	                </div>
	                <div class="line-input">
	                    <label class="lnr lnr-camera"></label>
	                    <input type="file" accept="image/jpeg,image/gif,image/png,image/x-eps" placeholder="Imagén" name="Imagen" required>
	                </div>
	                <div class="line-input">
	                    <label class="lnr lnr-eye"></label>
	                    <input type="file" accept="image/jpeg,image/gif,image/png,image/x-eps" placeholder="Kanji" name="Kanji" required>
	                </div>
	            
                    <div class="mensaje">
                        <?php
                        switch ($msj) {
                            case 1:
                                echo '<p align="center" >Se ha Agregado el Estímulo Correctamente';
                                break;
                            case 2:
                                echo '<p align="center"> Problemas al Agregar el Estímulo, favor Revisar';
                                break;
                            case 3:
                                echo '<p align="center"> El Estímulo YA existe, favor Revisar';
                                break;
                            case 4:
                                echo '<p align="center"> Lo Siento, La imagen YA existe.';
                                break;
                            case 5:
                                echo '<p align="center"> El archivo NO es una imagen.';
                                break;
                            case 6:
                                echo '<p align="center"> Lo siento, Su imagen es muy grande.';
                                break;
                            case 7:
                                echo '<p align="center"> Lo siento, solo imagenes JPG, JPEG, PNG & GIF están permitidos.';
                                break;
                            case 8:
                                echo '<p align="center"> Lo siento, Su Imagen NO fue cargada.';
                                break;
                            case 9:
                                echo '<p align="center"> Lo siento, hubo un error cargando su imagen.';
                                break;
                            case 10:
                                echo '<p align="center"> Lo siento, El kanji YA existe.';
                                break;
                            case 11:
                                echo '<p align="center"> Lo siento, Su kanji es muy grande.';
                                break;
                            case 12:
                                echo '<p align="center"> Lo siento, solo kanji en JPG, JPEG, PNG & GIF están permitidos.';
                                break;
                            case 13:
                                echo '<p align="center"> Lo siento, Su Kanji NO fue cargado.';
                                break;
                            case 14:
                                echo '<p align="center"> Lo siento, hubo un error cargando su kanji.';
                                break;
                        }
                        ?>            
                     </div>
	            
    	            <button type="submit">Guardar Estímulo<label class="lnr lnr-chevron-right"></label></button>
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