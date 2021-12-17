<?php
session_start();
$title = "Misdatos";
require_once("cabecera.php");
require_once("iniciolog.inc");
?>
<main>

    <?php
    if (isset($_SESSION['acceso'])) {
        $usuactual = $_SESSION['name'];
    ?>

        <section>
            <h2>Mis datos</h2>

            <?php


            $link = @mysqli_connect(
                'localhost',   // El servidor
                'root',     // El usuario
                '',            // La contraseña
                'pibd'
            ); // La base de datos

            if (!$link) {
                echo '<p>Error al conectar con la base de datos:' . mysqli_connect_error();
                echo '</p>';
                exit;
            } // Ejecuta una sentencia SQL


            $sentencia = "SELECT * FROM usuarios";


            if (!($resultado = @mysqli_query($link, $sentencia))) {
                echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                echo '</p>';
                exit;
            }

            $idi = "cosa";


            while ($fila = mysqli_fetch_assoc($resultado)) {
                if ($fila['NomUsuario'] == $usuactual) {

                    $metepasi = $fila['Pais'];
                    $sentenciapa = "SELECT * FROM paises where IdPais = $metepasi";

                    if (!($resultadopa = @mysqli_query($link, $sentenciapa))) {
                        echo '<p>Error al ejecutar la sentencia <b>$sentenciapa</b>: ' . mysqli_error($link);
                        echo '</p>';
                        exit;
                    }

                    $idi = $fila['IdUsuario'];
                    echo "<article class='inicio'>";
                    echo "<br><h3> Mis datos actuales </h3>";
                    echo "<img src=" . $fila['Foto'] . ">";
                    echo "<br><p>Nombre de usuario: <strong> " .  $fila['NomUsuario'] . "</strong></p>";
                    echo "<br><p> Correo electronico : <strong>" .  $fila['Email'] . "</strong></p>";

                    if ($fila['Sexo'] == 0) {
                        echo "<br><p> Genero : <strong> Hombre </strong></p>";
                    } else {
                        echo "<br><p> Genero : <strong> Mujer </strong></p>";
                    }

                    echo "<br><p> Ciudad : <strong>" .  $fila['Ciudad'] . "</strong></p>";

                    while ($filapa = mysqli_fetch_assoc($resultadopa)) {

                        echo "<br><p> Pais : <strong>" .  $filapa['NomPais'] . "</strong></p>";
                    }


                    list($dia, $hora) = explode(" ", $fila['FRegistro']);

                    list($anyo, $mes, $dai) = explode("-", $dia);


                    echo "<br><p>Fecha de incorporación :  A las <strong>" .  $hora . "</strong> el <strong>" .  $dai . "</strong>/<strong>" . $mes  . "</strong>/<strong>"  . $anyo  . "</strong></p>";
                    echo "</article>";
                }
            }

            ?>

            <div id="divForm" class="formuresponsive">
                <form action="respuestaMisDatos.php" method="POST" enctype="multipart/form-data">
                    <!-- Usuario con autofocus y obligatorio -->
                    <div class="row">
                        <div class="col-25">
                            <label for="user">Usuario:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="user" name="user" placeholder="Pepe">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Contraseñas obligatorias -->
                        <div class="col-25">
                            <label for="password">Nueva contraseña:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="password" name="password" placeholder="tucontraseña">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-25">
                            <label for="password2">Repetir nueva contraseña:</label>
                        </div>
                        <div class="col-75">
                            <input type="password" id="password2" name="password2" placeholder="tucontraseña">
                        </div>
                    </div>

                    <!-- Email obligatorio -->
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email: </label>
                        </div>
                        <div class="col-75">
                            <input type="text" name="email" id="email" placeholder="pepe@gmail.com">
                        </div>
                    </div>

                    <!-- Sexo -->
                    <div class="row">
                        <div class="col-25">
                            <label for="sexo">Sexo: </label>
                        </div>
                        <div>
                            <input type="radio" id="check1" name="sexo" value="Hombre" checked><label for="check1">Hombre</label>
                            <input type="radio" id="check2" name="sexo" value="Mujer"><label for="check2">Mujer</label>
                        </div>

                    </div>
                    <!-- Si pones dos id da error de validacion porque se repiten -->

                    <!-- Fecha obligatoria -->
                    <div class="row">
                        <div class="col-25">
                            <label for="fecha">Fecha de nacimiento: </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="fecha" name="fecha">
                        </div>
                    </div>

                    <!--Ciudad obligatoria -->
                    <div class="row">
                        <div class="col-25">
                            <label for="ciudad">Ciudad: </label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="ciudad" name="ciudad" placeholder="Alicante">
                        </div>
                    </div>

                    <!-- Lista de paises -->
                    <div class="row">
                        <div class="col-25">
                            <label for="selectpais">País lista: </label>
                        </div>
                        <div class="col-75">
                            <select name="selectpais" id="selectpais">
                                <?php

                                $link = @mysqli_connect(
                                    'localhost',   // El servidor
                                    'root',     // El usuario
                                    '',            // La contraseña
                                    'pibd'
                                ); // La base de datos

                                if (!$link) {
                                    echo '<p>Error al conectar con la base de datos:' . mysqli_connect_error();
                                    echo '</p>';
                                    exit;
                                } // Ejecuta una sentencia SQL

                                $sentencia = "SELECT * FROM paises";

                                if (!($resultado = @mysqli_query($link, $sentencia))) {
                                    echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                                    echo '</p>';
                                    exit;
                                }

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<option>" .  $fila['NomPais'] . "</option>";
                                }

                                ?>
                                <!-- <option value="España">España</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Francia">Francia</option>
                            <option value="Rusia">Rusia</option> -->
                            </select>
                        </div>
                    </div>

                    <!-- Foto obligatoria -->
                    <div class="row">
                        <div class="col-25">
                            <label for="foto">Foto de perfil: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="file" id="foto" name="perfil" accept="image/png,image/jpeg"><br>
                        </div>
                    </div><br>

                    <input type="submit" value="Enviar" class="enviar" />
                </form>
            </div>
        </section>

    <?php
    } else {
        header("Location: ../php/index.php?mail=3");
    }
    ?>

</main>
<?php
require_once("pie.inc");
?>