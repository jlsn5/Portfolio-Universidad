<?php
session_start();
$title = "Perfil";
require_once("cabecera.php");
require_once("iniciolog.inc");
?>

<main>

    <?php
    $corta = $_SERVER['REQUEST_URI'];

    list($noimporta, $importa) = explode("?", $corta);

    echo '<h1>'.$importa.'</h1>';

    $link = @mysqli_connect(
        'localhost',   // El servidor
        'root',     // El usuario
        '',            // La contraseña
        'pibd'
    ); // La base de datos

    if (!$link) {
        echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
        echo '</p>';
        exit;
    } // Ejecuta una sentencia SQL


    $sentencia = "SELECT * FROM albumes";

    if(!($resultado = @mysqli_query($link, $sentencia))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo'</p>';
        exit;
    }


    while ($fila = mysqli_fetch_assoc($resultado)) {
        if($fila['Titulo']==$importa){
            echo "<p>Descripción: <strong>" .  $fila['Descripcion'] . "</strong></p>";

            $alb = $fila['IdAlbum'];
        } 
    }


    $sentencia2 = "SELECT * FROM fotos";

    if (!($resultado2 = @mysqli_query($link, $sentencia2))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo '</p>';
        exit;
    }

    //$fila2 = mysqli_fetch_assoc($resultado2);

    while ($fila2 = mysqli_fetch_assoc($resultado2)) {
        if ($fila2['Album'] == $alb) {
            echo "<div class='img-container'>";
            echo "<img src=" . $fila2['Fichero'] . "weight='200' height='144'" . $fila2['Alternativo'] . ">";
            $paisin = $fila2['Pais'];
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

    $sentencia3 = "SELECT * FROM albumes";

    if (!($resultado3 = @mysqli_query($link, $sentencia3))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo '</p>';
        exit;
    }

    while ($fila3 = mysqli_fetch_assoc($resultado3)) {
        if ($fila3['IdAlbum'] == $alb) {
            echo "<div class='img-container'><a href='añadirfoto.php?mail=" . $fila3['Titulo'] . "'> <h3>Añadir foto a álbum</h3></a></div>";
        }
    }

    ?>
</main>

<?php
require_once("pie.inc");
?>