<?php
@ob_start();
session_start();
$title = "Index";
require_once("cabecera.php");
require_once("inicio.inc");
?>
<main>

    <?php

    if (!isset($_COOKIE['usuario'])) {

        if (isset($_GET['mail']) && $_GET['mail'] == 1) {
    ?>

            <script type="text/javascript">
                alert('Usuario o contraseña incorrectos');
            </script>

        <?php
        }

        if (isset($_GET['mail']) && $_GET['mail'] == 2) {
        ?>

            <script type="text/javascript">
                alert('Error al acceder a la base de datos.');
            </script>

        <?php
        }
        ?>

        <?php
        if (isset($_GET['mail']) && $_GET['mail'] == 3) {

            session_destroy();
        ?>

            <script type="text/javascript">
                alert('Debes iniciar sesión para acceder a esta página');
            </script>

        <?php
        }
        ?>

        <?php
        if (isset($_GET['mail']) && $_GET['mail'] == 4) {

            session_destroy();
        ?>

            <script type="text/javascript">
                alert('Has cambiado tus datos, vuelve a iniciar session');
            </script>

        <?php
        }
        ?>

        <section>

            <h2 id="logintext">Login</h2>
            <form action="../php/controlAcceso.php" method="POST" id="login">
                <label for="user">Usuario:</label><br>
                <input type="text" id="user" name="user" placeholder="Pepe"><br>
                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="password" placeholder="tu contraseña"><br>
                <label for="save">Recordarme en este equipo <input type="checkbox" name="save" id="save"></label><br>
                <input class="enviar" type="submit" value="Enviar" />
            </form>


        </section>
        <br>
        <section>

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


        $sentencia = "SELECT * FROM fotos ORDER BY FRegistro DESC";


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
                echo "<a href='detallePub.php?mail=" . $fila['IdFoto'] . "'><img src=" . $fila['Fichero'] . "weight='200' height='144'" . $fila['Alternativo'] . "></a>";
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
    } else {
        header("Location: ../php/indexlog.php");
    }
        ?>

</main>
<?php
require_once("pie.inc");
?>