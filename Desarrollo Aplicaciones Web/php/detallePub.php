<?php
session_start();
$title = "Detalle";
require_once("cabecera.php");
require_once("inicio.inc");
require_once("inicioBD.php");
?>

<main>

<?php

    $foto = $_GET['mail'];

    $sentencia = "SELECT * FROM fotos WHERE IdFoto=$foto";

    if (!($resultado = @mysqli_query($link, $sentencia))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo '</p>';
        exit;
    }

    $cont = 0;

    while ($fila = mysqli_fetch_assoc($resultado)) {

        //ATENCION!!! EN ESTAS CONSULTAS FALTAN LOS FILTROS DE SEGURIDAD COMO EL QUE TIENE PAIS MAS ABAJO

        //Consulta a Album
        $album = $fila['Album'];

        $sentencia3 = "SELECT * FROM albumes WHERE IdAlbum=$album";

        $resultado3 = @mysqli_query($link, $sentencia3);

        $fila3 = mysqli_fetch_assoc($resultado3);

        //Consulta a Usuario a partir de Album
        $usu = $fila3['Usuario'];

        $sentencia4 = "SELECT * FROM usuarios WHERE IdUsuario=$usu";

        $resultado4 = @mysqli_query($link, $sentencia4);

        $fila4 = mysqli_fetch_assoc($resultado4);

        if ($cont < 5) {
            $cont++;

            echo "<div>";
            echo "<h3><strong>" .  $fila['Titulo'] . "</strong></h3>";
            echo "<a href='detalle.php?mail=" . $fila['IdFoto'] . "'><img src=" . $fila['Fichero'] . "weight='200' height='144'" . $fila['Alternativo'] . "></a>";
            echo "<p>Fecha: <strong>" .  $fila['Fecha'] . "</strong></p>";
            echo "<p>Descripción: <strong>" .  $fila['Descripcion'] . "</strong></p>";
            echo "<p>Álbum: <strong><a href=verAlbumPub.php?" .  $fila3['Titulo'] . ">" .  $fila3['Titulo'] . "</a></strong></p>";
            echo "<p>Usuario: <strong><a href=perfil.php?" .  $fila4['NomUsuario'] . ">" .  $fila4['NomUsuario'] . "</a></strong></p>";

            //Consulta pais
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

</main>

<?php
require_once("pie.inc");
?>