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
            $objEstimulo = new Estimulo();
            $resEstimulo = $objEstimulo->consultarEstimulo($pregunta["idMuestra"]);
            $estimulo = $resEstimulo->fetch(PDO::FETCH_ASSOC);
            $objTipo = new Tipo();
            $resTipo = $objTipo->consultarTipo($pregunta["idTipoMuestra"]);
            $tipo = $resTipo->fetch(PDO::FETCH_ASSOC);
            if (!empty($pregunta["FraseEstimulo"])){
                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoMuestra"] .             ';url=../controlador/preguntarfe.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '&inicio=' . $inicio . '" />';
            } else {
                echo '<meta http-equiv="Refresh" content="' . $fase["TiempoMuestra"] .             ';url=../controlador/preguntare.php?idPregunta=' . $idPregunta . '&idFase=' . $idFase . '&idModelo=' . $idModelo . '&idPrueba=' . $idPrueba . '&idAprendiz=' . $idAprendiz . '&inicio=' . $inicio . '" />';
            }
        ?>
        <link rel="stylesheet" href="../recursos/style.css">
        <link rel="stylesheet" href="../css/style5.css">
    </head>
	<body>
        <section>
            <?php
                if ($fase["Diccionario"] == 0){
                    switch ($tipo["Nombre"]) {
                        case "Palabra": 
                            echo "<h2>" . $estimulo["Palabra"] . "</h2>";
                            break;
                        case "Kanji": 
                            echo '<img class="Img" src="' . $estimulo["Kanji"] . '" alt="">';
                            break;
                        case "Imagen": 
                            echo '<img class="Img" src="' . $estimulo["Imagen"] . '" alt="">';
                            break;
                    }
                }
            ?>
        </section>
        <script src="../js/jquery-3.3.1.min.js"></script>
        <script src="../js/menu.js"></script>
	</body>
</html>