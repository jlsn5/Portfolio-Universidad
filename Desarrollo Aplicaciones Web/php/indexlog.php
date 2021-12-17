<?php
session_start();
$title = "Index Logueado";
require_once("cabecera.php");
require_once("inicioLog.inc");
require_once("inicioBD.php");

$nombre1 = 'Juan';
$nombre2 = 'Pepe';
$nombre3 = 'Antonio';
$nombre4 = 'Sonia';
$nombre5 = 'sinNada';
$contraseña = hash('sha256', '1234');
?>
<main>

    <?php

    if(isset($_SESSION['acceso']) || ((isset($_COOKIE['usuario'])) && 
        ($nombre1 == $_COOKIE['usuario'] || $nombre2 == $_COOKIE['usuario'] || $nombre3 == $_COOKIE['usuario'] || $nombre4 == $_COOKIE['usuario'] || $nombre5 == $_COOKIE['usuario']) && 
        ($contraseña == $_COOKIE['contrasena'])) ){

        if(isset($_COOKIE['usuario'])){
            list($dia, $hora) = explode(" ", $_COOKIE["fechahora"]);

            $nom = $_COOKIE['usuario'];

            echo "<p>Hola <strong>" . $nom . "</strong> su ultima visita fue el <strong>" . $dia . "</strong> a las <strong>" .  $hora . "</strong></p>";
        }

        $sentencia = "SELECT * FROM fotos";

        if (!($resultado = @mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo '</p>';
            exit;
        }

        $cont = 0;

        while ($fila = mysqli_fetch_assoc($resultado)) {

            if ($cont < 5) {
                $cont++;

                echo "<div class='img-container'>";
                echo "<h3><strong>" .  $fila['Titulo'] . "</strong></h3>";
                echo "<a href='detalle.php?mail=" . $fila['IdFoto'] . "'><img src=" . $fila['Fichero'] . "weight='200' height='144'" . $fila['Alternativo'] . "></a>";
                // echo "<p> src=" . $fila['Fichero'] . "</p>";
                echo "<p>Fecha: <strong>" .  $fila['FRegistro'] . "</strong></p>";

                $paisin = $fila['Pais'];
                $sentenciain = "SELECT NomPais FROM paises WHERE IdPais = $paisin";
                $resultadoin = @mysqli_query($link, $sentenciain);
                if (!($resultadoin = @mysqli_query($link, $sentenciain))) {
                    echo '<p>Error al ejecutar la sentencia <b>$sentenciain</b>: ' . mysqli_error($link);
                    echo '</p>';
                    exit;
                }
                while ($filain = mysqli_fetch_assoc($resultadoin)) {
                    echo "<p>Pais: <strong> " .   $filain['NomPais']  . "</strong></p>";
                }
                echo "</div>";
            }
        }
    
        ?>

        <?php


        // $nomdir = './';
        echo "<h2>Foto del día</h2>\n";
        echo "<div class='img-container'>";
        if(($fichero = @file("file.php")) == false){
            echo "No se ha podido abrir el fichero";
        }
        else{
            echo "<pre>\n";
            $numRandom = rand(1, 3);
            foreach($fichero as $numLinea => $linea){
                // echo "Línea #<b>" . sprintf(" %03d", $numLinea) . "</b> : ";
                $separadas = explode("-", $linea);

                $sentencia2 = "SELECT * FROM fotos WHERE IdFoto = $separadas[0] ";

                
                // $auxlong = strlen($numRandom);

                // if($auxlong > 1){
                //     $numRandom = substr($numRandom, 0, -1);
                // }
                // echo $numRandom;

                if($separadas[0] == $numRandom ){
                    //MOSTRAR FOTO
                    if (!($resultado = @mysqli_query($link, $sentencia2))) {
                        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }
                    while ($fila = mysqli_fetch_assoc($resultado)) {

                            echo "<h3><strong>" .  $fila['Titulo'] . "</strong></h3>";
                            echo "<a href='detalle.php?mail=" . $fila['IdFoto'] . "'><img src=" . $fila['Fichero'] . "weight='200' height='144'" . $fila['Alternativo'] . "></a>";
                            echo "<p>Fecha: <strong>" .  $fila['FRegistro'] . "</strong></p>";
            
                            $paisin = $fila['Pais'];
                            $sentenciain = "SELECT NomPais FROM paises WHERE IdPais = $paisin";
                            $resultadoin = @mysqli_query($link, $sentenciain);
                            if (!($resultadoin = @mysqli_query($link, $sentenciain))) {
                                echo '<p>Error al ejecutar la sentencia <b>$sentenciain</b>: ' . mysqli_error($link);
                                echo '</p>';
                                exit;
                            }
                            while ($filain = mysqli_fetch_assoc($resultadoin)) {
                                echo "<p>Pais: <strong> " .   $filain['NomPais']  . "</strong></p>";
                            }
                    }
                    // echo htmlspecialchars($linea);
                    echo "<h3>Autor y comentario</h3>\n";
                    echo $separadas[1];
                    echo "\n";
                    echo $separadas[2];
                    // fclose($fichero);

                }
            }
            echo "</pre>\n";
        }
        echo "</div>";


        echo "<h2>Consejo fotográfico</h2>\n";
        echo "<div class='img-container'>";
        
        define('JSON', 'consejosFotograficos.json');
        $data = file_get_contents(JSON);
    
        $items = json_decode($data, true);

        $random = rand(1, 3);

        
        if($random == 1){
            echo "Categoria: " . $items['Consejo1']['Categoria'] . "<br>";
            echo "Dificultad: " . $items['Consejo1']['Dificultad'] . "<br>";
            echo "Consejo: " . $items['Consejo1']['Consejo'] . "<br>";
        }

        if ($random == 2) {
            echo "Categoria: " . $items['Consejo2']['Categoria'] . "<br>";
            echo "Dificultad: " . $items['Consejo2']['Dificultad'] . "<br>";
            echo "Consejo: " . $items['Consejo2']['Consejo'] . "<br>";
        }

        if ($random == 3) {
            echo "Categoria: " . $items['Consejo3']['Categoria'] . "<br>";
            echo "Dificultad: " . $items['Consejo3']['Dificultad'] . "<br>";
            echo "Consejo: " . $items['Consejo3']['Consejo'] . "<br>";
        }
            
        echo "</div>";
        ?>

    <?php
    }else{
        header("Location: ../php/index.php?mail=3");
    }
    ?>

</main>
<?php
require_once("pie.inc");
?>