<?php
session_start();
$title = "Configurar";
require_once("cabecera.php");
require_once("inicioLog.inc");

if (isset($_SESSION['acceso'])) {
    $usuactual = $_SESSION['name'];
?>

<main>

    <h1>Configurar estilos</h1>

    <div>

        <?php


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

        // WHERE idEstilo = {$idi}
        $sentencia2 = "SELECT * FROM estilos ";

        if (!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo '</p>';
            exit;
        }

        echo "<ul>";
        while ($fila2 = mysqli_fetch_assoc($resultado2)) {
            // echo "<li>";
            // echo "<p> " .  $fila2['Nombre'] . "</p>";
            // echo "</li>";

            $animales = array($fila2['Nombre']);
        }
        echo "</ul>";

        ?>

        <section>
            <h2>ESTILOS</h2>
            <article>
                <form action="respuestaConfigurar.php" method="POST">
                    <?php if (isset($_SESSION['estilo']))
                        echo $_SESSION['estilo'] ?>
                    <label>Estilo predeterminado<input type="radio" name="estilo" value="5"></label><br>
                    <label>Estilo noche<input type="radio" name="estilo" value="1"></label><br>
                    <label>Estilo alto contraste<input type="radio" name="estilo" value="2"></label><br>
                    <label>Estilo accesible<input type="radio" name="estilo" value="3"></label><br>
                    <label>Estilo letra grande<input type="radio" name="estilo" value="4"></label><br>
                    <input type="submit" name="submitcam" value="Cambiar">
            </article>
        </section>

        <?php

        ?>
    </div>

    <?php
    } else {
        header("Location: ../php/index.php?mail=3");
    }
    ?>

</main>

<?php
require_once("pie.inc");
?>