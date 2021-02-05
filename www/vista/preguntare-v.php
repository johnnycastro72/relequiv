<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <?php
            extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
            require "../modelo/conectar.php";
            require "../modelo/Fase.php";
            require "../modelo/Estimulo.php";
            require "../modelo/Tipo.php";
            require "../modelo/Pregunta.php";
            //Creamos el objeto Fase, Estimulo, Tipo y Pregunta.
            $idPrueba = $_REQUEST["idPrueba"];
            $idModelo = $_REQUEST["idModelo"];
            $idAprendiz = $_REQUEST["idAprendiz"];
            $idFase = $_REQUEST["idFase"];
            $idPregunta = $_REQUEST["idPregunta"];
            $inicio = $_REQUEST["inicio"];
            $objFase = new Fase();
            $resFase = $objFase->consultarFase($idFase);
            $fase = $resFase->fetch(PDO::FETCH_ASSOC);
            $objPregunta = new Pregunta();
            $resPreguntas = $objPregunta->consultarPreguntas($idFase);
            $resPregunta = $objPregunta->consultarPregunta($idPregunta);
            $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
            $entrenamiento = $pregunta["Entrenamiento"];
            $evaluacion = $fase["Evaluacion"];
            $objTipo = new Tipo();
            $resTM = $objTipo->consultarTipo($pregunta["idTipoMuestra"]);
            $TM = $resTM->fetch(PDO::FETCH_ASSOC);
            $resTE = $objTipo->consultarTipo($pregunta["idTipoEstimulo"]);
            $TE = $resTE->fetch(PDO::FETCH_ASSOC);
            $objMuestra = new Estimulo();
            $resMuestra = $objMuestra->consultarEstimulo($pregunta["idMuestra"]);
            $muestra = $resMuestra->fetch(PDO::FETCH_ASSOC);
            $resEstimulo = $objMuestra->obtenerEstimulo($pregunta["idMuestra"]);
            if (!empty($fase["TiempoEstimulo"])) {
                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoEstimulo"] . ';url=../controlador/preguntarf.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '&inicio=' . $inicio . '&intento=1&acierto=1' . '" />';
            }
        ?>
        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style6.css">
    </head>
	<body>
        <section>
            <?php
                if ($fase["Diccionario"] == 1){
                    echo '<img class="imgdic" src="' . $pregunta["FraseFinal"] . '" alt="">';
                    echo '<form action="../controlador/preguntarf.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '&inicio=' . $inicio  . '&intento=1&acierto=1' . '" method="post" enctype="multipart/form-data" class="form">';
                    echo '<button type="submit">Continuar<label class="lnr lnr-chevron-right"></label></button>';
                    echo '</form>';
                } elseif (!empty($fase["TiempoEstimulo"])) {
                    echo '<table>';
                    echo '<tr><td class="td1" colspan="2"><img class="kanji2" src="' . $muestra["Kanji"] . '" alt=""></td></tr>';
                    echo '<tr>';
                    echo '<td class="td2"><p class="palabra2">' . $muestra["Palabra"] . "</p></td>";
                    echo '<td class="td2"><img class="imagen2" src="' . $muestra["Imagen"] . '" alt=""></td>';
                    echo '</tr>';
                    echo '</table>';
                } else {
                    switch ($TE["Nombre"]) {
                        case "Palabra": 
                            $estimulos[] = array($muestra["Palabra"], "Acierto");
                            $i = 0;
                            while ($estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC))
                            {
                                ++$i;
                                $estimulos[] = array($estimulo["Palabra"], "Falla".$i);
                            }
                            break;
                        case "Kanji": 
                            $estimulos[] = array($muestra["Kanji"], "Acierto");
                            $i = 0;
                            while ($estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC))
                            {
                                ++$i;
                                $estimulos[] = array($estimulo["Kanji"], "Falla".$i);
                            }
                            break;
                        case "Imagen": 
                            $estimulos[] = array($muestra["Imagen"], "Acierto");
                            $i = 0;
                            while ($estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC))
                            {
                                ++$i;
                                $estimulos[] = array($estimulo["Imagen"], "Falla".$i);
                            }
                            break;
                    }
                    shuffle($estimulos);
                    echo '<table>';
                    echo '<tr>';
                    echo '<td class="td3">';
                    if ($TE["Nombre"]=="Palabra") {
                        echo '<p class="' . $estimulos[0][1] . '">' . $estimulos[0][0] . '</p>';
                    } else {
                        echo '<img class="' . $estimulos[0][1] . '" src="' . $estimulos[0][0] . '" alt="">';
                    }
                    echo '</td>';
                    echo '<td class="td3" rowspan="2">';
                    if ($TM["Nombre"]=="Palabra") {
                        echo '<p class="palabra">' . $muestra["Palabra"] . '</p>';
                    } elseif ($TM["Nombre"]=="Kanji") {
                        echo '<img class="kanji" src="' . $muestra["Kanji"] . '" alt="">';
                    } else {
                        echo '<img class="imagen" src="' . $muestra["Imagen"] . '" alt="">';
                    }
                    echo '</td>';
                    echo '<td class="td3">';
                    if ($TE["Nombre"]=="Palabra") {
                        echo '<p class="' . $estimulos[1][1] . '">' . $estimulos[1][0] . '</p>';
                    } else {
                        echo '<img class="' . $estimulos[1][1] . '" src="' . $estimulos[1][0] . '" alt="">';
                    }
                    echo '</td>';
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="td3">';
                    if ($TE["Nombre"]=="Palabra") {
                        echo '<p class="' . $estimulos[2][1] . '">' . $estimulos[2][0] . '</p>';
                    } else {
                        echo '<img class="' . $estimulos[2][1] . '" src="' . $estimulos[2][0] . '" alt="">';
                    }
                    echo '</td>';
                    echo '<td class="td3">';
                    if ($TE["Nombre"]=="Palabra") {
                        echo '<p class="' . $estimulos[3][1] . '">' . $estimulos[3][0] . '</p>';
                    } else {
                        echo '<img class="' . $estimulos[3][1] . '" src="' . $estimulos[3][0] . '" alt="">';
                    }
                    echo '</td>';
                    echo '</tr>';
                    echo '</table>';
                }
            ?>
        </section>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/menu.js"></script>
        <script>
            function alert(msg, type){
                var html =  '<div class="alertContainer '+type+'">\n';
                html +=     '   <div class="mensajeAlert">'+msg+'</div>\n';
                html +=     '   <div class="cerrarAlert">x</div>\n';
                html +=     '</div>';
                jQuery('body').append(html);
                window.setTimeout(function(){jQuery('.alertContainer').addClass('active')}, 500);
                jQuery('.cerrarAlert').click(function(){
                    jQuery('.alertContainer').removeClass('active');
                    window.setTimeout(function(){jQuery('.alertContainer').remove()}, 500);
                });
            }

            $(document).ready(function() {
                var intentos = 0;
                var idPrueba = "<?php echo $idPrueba ?>";
                var idModelo = "<?php echo $idModelo ?>";
                var idAprendiz = "<?php echo $idAprendiz ?>";
                var idFase = "<?php echo $idFase ?>";
                var idPregunta = "<?php echo $idPregunta ?>";
                var inicio = "<?php echo $inicio ?>";
                var entrenamiento = "<?php echo $entrenamiento ?>";
                var evaluacion = "<?php echo $evaluacion ?>";
                $(".Acierto").click( function() {
                    if (evaluacion == 0) {
                        var audio = new Audio('../recursos/Good.mp3');
                        audio.play();
                        intentos++;
                        var canvas = document.createElement('canvas'); 
                        canvas.style.width='100%';
                        canvas.style.height='100%';
                        canvas.width = window.innerWidth;
                        canvas.height = window.innerHeight;
                        canvas.style.position='absolute';
                        canvas.style.left=0;
                        canvas.style.top=0;
                        canvas.style.zIndex=100000;
                        canvas.style.pointerEvents='none';
                        document.body.appendChild(canvas); 
                        var context = canvas.getContext('2d');                 
                        context.rect(0, 0, window.innerWidth, window.innerHeight);
                        context.fillStyle = 'green';
                        context.fill();
                        setTimeout(function() {
                        location.href ="../controlador/preguntarf.php?idPregunta=" + idPregunta + "&idFase=" + idFase + "&idModelo=" + idModelo + "&idPrueba=" + idPrueba + "&idAprendiz=" + idAprendiz + "&inicio=" + inicio + "&intento=" + intentos + "&acierto=1";
                        }, 3000);
                    } else {
                        intentos++;
                        location.href ="../controlador/preguntarf.php?idPregunta=" + idPregunta + "&idFase=" + idFase + "&idModelo=" + idModelo + "&idPrueba=" + idPrueba + "&idAprendiz=" + idAprendiz + "&inicio=" + inicio + "&intento=" + intentos + "&acierto=1";
                    }
                });//Fin Acierto
                $(".Falla1").click( function() {
                    if (evaluacion == 0) {
                        var audio = new Audio('../recursos/bad.mp3');
                        audio.play();
                        $(".Falla1").fadeOut(2000);
                        intentos++;
                    } else {
                        intentos++;
                        location.href ="../controlador/preguntarf.php?idPregunta=" + idPregunta + "&idFase=" + idFase + "&idModelo=" + idModelo + "&idPrueba=" + idPrueba + "&idAprendiz=" + idAprendiz + "&inicio=" + inicio + "&intento=" + intentos + "&acierto=0";
                    }
                    if (entrenamiento == 1) {
                        alert("Selecciona otra opción", "error");
                    }
                });//fin Falla1
                $(".Falla2").click( function() {
                    if (evaluacion == 0) {
                        var audio = new Audio('../recursos/bad.mp3');
                        audio.play();
                        $(".Falla2").fadeOut(2000);
                        intentos++;
                    } else {
                        intentos++;
                        location.href ="../controlador/preguntarf.php?idPregunta=" + idPregunta + "&idFase=" + idFase + "&idModelo=" + idModelo + "&idPrueba=" + idPrueba + "&idAprendiz=" + idAprendiz + "&inicio=" + inicio + "&intento=" + intentos + "&acierto=0";
                    }
                    if (entrenamiento == 1) {
                        alert("Selecciona otra opción", "error");
                    }
                });//fin Falla2
                $(".Falla3").click( function() {
                    if (evaluacion == 0) {
                        var audio = new Audio('../recursos/bad.mp3');
                        audio.play();
                        $(".Falla3").fadeOut(2000);
                        intentos++;
                    } else {
                        intentos++;
                        location.href ="../controlador/preguntarf.php?idPregunta=" + idPregunta + "&idFase=" + idFase + "&idModelo=" + idModelo + "&idPrueba=" + idPrueba + "&idAprendiz=" + idAprendiz + "&inicio=" + inicio + "&intento=" + intentos + "&acierto=0";
                    }
                    if (entrenamiento == 1) {
                        alert("Selecciona otra opción", "error");
                    }
                });//fin Falla3
            });//Fin
        </script>
    </body>
</html>