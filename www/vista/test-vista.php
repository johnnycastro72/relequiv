<!DOCTYPE HTML5>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style3.css">
	</head>
	<body id="cuerpo">
       <header id="prnenc">
           <h2>Aplicando la Prueba</h2>
           <input type="checkbox" id="btn-menu">
           <label for="btn-menu"> <i class="lnr lnr-menu"></i></label>

           <nav class="menu">
               <ul>
                <li><a href="../controlador/cerrar.php"><span class="lnr lnr-exit"></span> Salir</a></li>
               </ul>
           </nav>
      </header>
       <section id="seccion">
            <div class="container-form">
    	        <form action="../controlador/ApreValidarInsertar.php"  method="post" class="form">
    	            <div class="welcome-form">
                        <h4>Digite sus Datos Personales</h4>
	                </div>
                    <input type="hidden" name="idAprendiz">

                    <?php
                    require "../modelo/conectar.php";
                    require "../modelo/Carrera.php";
                    require "../modelo/Semestre.php";
                    require "../modelo/Nivel.php";
                    // creamos los objetos Aprendiz, Modelo, Carrera, Semestre y Nivel
                    $objCarrera = new Carrera();
                    $resCarrera = $objCarrera->consultarCarreras();
                    $optCarrera = '<option value="" disabled="disabled" selected="selected">Seleccione...</option>';
                    while ($fila = $resCarrera->fetch(PDO::FETCH_ASSOC))
                    {
                        $optCarrera .= '<OPTION';
                        $optCarrera .= ' VALUE="' . $fila["idCarrera"] . '">' . $fila["Nombre"] . '</option>';
                    }
                    $objSemestre = new Semestre();
                    $resSemestre = $objSemestre->consultarSemestres();
                    $optSemestre = '<option value="" disabled="disabled" selected="selected">Seleccione...</option>';
                    while ($fila3 = $resSemestre->fetch(PDO::FETCH_ASSOC))
                    {
                        $optSemestre .= '<OPTION';
                        $optSemestre .= ' VALUE="' . $fila3["idSemestre"] . '">' . $fila3["Nombre"] . '</option>';
                    }
                    $objNivel = new Nivel();
                    $resNivel = $objNivel->consultarNiveles();
                    $optNivel = '<option value="" disabled="disabled" selected="selected">Seleccione...</option>';
                    while ($fila2 = $resNivel->fetch(PDO::FETCH_ASSOC))
                    {
                        $optNivel .= '<OPTION';
                        $optNivel .= ' VALUE="' . $fila2["idNivel"] . '">' . $fila2["Nombre"] . '</option>';
                    }
                    ?>
                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="number" placeholder="Cédula:" name="Cedula" value="" style="text-transform: uppercase;" required> 
                    </div>

                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Primer Apellido:" name="Apellido1" value="" style="text-transform: uppercase;" required> 
                    </div>

                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Segundo Apellido:" name="Apellido2" value="" style="text-transform: uppercase;"> 
                    </div>

                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Primer Nombre:" name="Nombre1" value="" style="text-transform: uppercase;" required> 
                    </div>

                    <div class="line-input">
	                    <label class="lnr lnr-keyboard"></label>
	                    <input type="text" placeholder="Segundo Nombre:" name="Nombre2" value="" style="text-transform: uppercase;"> 
                    </div>

                    <div class="line-input">
	                    <label class="lnr lnr-calendar-full"></label>
	                    <h5>Fecha Nacimiento: </h5><input type="date" placeholder="Fecha de Nacimiento" name="FechaNacimiento" max="<?php echo date('Y-m-d', strtotime('-18 year', strtotime(date('Y-m-d')))); ?>" required>
	                </div>
	            
                    <div class="line-input">
	                    <label class="lnr lnr-select"></label>
                        <h5>Sexo: </h5>
                        <select id="Sexo" name="Sexo" class="form-control" required="required">
                            <option value="" disabled="disabled" selected="selected">Seleccione...</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
	                </div>

                    <div class="line-input">
	                    <label class="lnr lnr-select"></label>
                        <h5>Carrera: </h5><select id="idCarrera" name="idCarrera" class="form-control" required="required">
                            <?php
                            echo $optCarrera;
                            ?>
                        </select>
	                </div>

                    <div class="line-input">
	                    <label class="lnr lnr-select"></label>
                        <h5>Semestre: </h5><select id="idSemestre" name="idSemestre" class="form-control" required="required">
                            <?php
                            echo $optSemestre;
                            ?>
                        </select>
	                </div>

                    <div class="line-input">
	                    <label class="lnr lnr-select"></label>
                        <h5>Nivel Académico: </h5><select id="idNivel" name="idNivel" class="form-control" required="required">
                            <?php
                            echo $optNivel;
                            ?>
                        </select>
	                </div>

                    <div class="mensaje">
                    </div>
	            
    	            <button type="submit">Comenzar<label class="lnr lnr-chevron-right"></label></button>
	            </form>
    		</div>
       </section>
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