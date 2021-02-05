<?php session_start();
    if(isset($_SESSION['usuario'])){
        if(isset($_GET["idPrueba"])){
            $idPrueba = $_GET["idPrueba"];
            header ('Content-type:application/xls; charset=UTF-8');
            header ('Content-Disposition: attachment; filename=falxls' . $idPrueba . '.xls');

            require "../modelo/conectar.php";
            require "../modelo/Fallido.php";
            require "../modelo/Nivel.php";
            require "../modelo/Carrera.php";
            require "../modelo/Semestre.php";
            require "../modelo/Modelo.php";

            function CalculaEdad( $fecha ) {
                list($Y,$m,$d) = explode("-",$fecha);
                return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
            }
                
            //Creamos el objeto Fallido, Nivel, Carrera, Semestre, Modelo
            $objFallido = new Fallido();
            $objNivel = new Nivel();
            $objCarrera = new Carrera();
            $objSemestre = new Semestre();
            $objModelo = new Modelo();
            $sexo = ["Masculino", "Femenino"];
            echo '<table>';
            echo '<tr>';
            echo '<th>IDENTIFICACION</th>';
            echo '<th>APELLIDOS</th>';
            echo '<th>NOMBRES</th>';
            echo '<th>EDAD</th>';
            echo '<th>GENERO</th>';
            echo '<th>NIVEL ACADEMICO</th>';
            echo '<th>CARRERA</th>';
            echo '<th>SEMESTRE</th>';
            echo '<th>MODELO</th>';
            echo '<th>FECHA Y HORA</th>';
            echo '</tr>';

            $resultado = $objFallido->consultarAprendices($idPrueba);
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC))
            {
                $edad = CalculaEdad($fila["FechaNacimiento"]);
                echo "<tr>";
                echo "<td align='center'>" . $fila["Cedula"] . "</td><td>" . trim(utf8_decode($fila["Apellido1"]) . " " . utf8_decode($fila["Apellido2"])) . "</td><td>" . trim(utf8_decode($fila["Nombre1"]) . " " . utf8_decode($fila["Nombre2"])) . "</td>" . "<td>" . $edad . "</td>" . "<td>" . $sexo[$fila["Sexo"]-1] . "</td>";
                $resNivel = $objNivel->consultarNivel($fila["idNivel"]);
                $nivel = $resNivel->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . utf8_decode($nivel["Nombre"]) . "</td>";
                $resCarrera = $objCarrera->consultarCarrera($fila["idCarrera"]);
                $carrera = $resCarrera->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . utf8_decode($carrera["Nombre"]) . "</td>";
                $resSemestre = $objSemestre->consultarSemestre($fila["idSemestre"]);
                $semestre = $resSemestre->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . utf8_decode($semestre["Nombre"]) . "</td>";
                $resModelo = $objModelo->consultarModelo($fila["idModelo"]);
                $modelo = $resModelo->fetch(PDO::FETCH_ASSOC);
                echo "<td>" . utf8_decode($modelo["Nombre"]) . "</td>";
                echo "<td>" . utf8_decode($fila["FechaHora"]) . "</td>";
                echo "</tr>";
            }

            echo '</table>';
        }
    }else{
        header ('location: login.php');
    }
?>