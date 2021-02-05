<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Relaciones de Equivalencia 1.0</title>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style4.css">
	</head>
	<body>
        <section>
            <?php
                extract($_REQUEST); //recoger todas las variables que pasan Método GET o POST
                require "../modelo/conectar.php";
                require "../modelo/Fase.php";
                require "../modelo/Pregunta.php";
                //Creamos el objeto Fase y Pregunta.
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
                $resPreguntas = $objPregunta->consultarPreguntas($fase["idFase"]);
                $resPregunta = $objPregunta->consultarPregunta($idPregunta);
                $pregunta = $resPregunta->fetch(PDO::FETCH_ASSOC);
                echo "<h4>" . $pregunta["FraseEstimulo"] . "</h4>";
            ?>
        </section>
        <?php
            echo '<form action="../controlador/preguntarfea.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '&inicio=' . $inicio . '" method="post" enctype="multipart/form-data" class="form">';
            echo '<button type="submit">Continuar<label class="lnr lnr-chevron-right"></label></button>';
            echo '</form>';
        ?>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/menu.js"></script>
	</body>
</html>