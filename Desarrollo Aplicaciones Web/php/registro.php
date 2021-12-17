<?php
$title = "Registro";
require_once("cabecera.php");
require_once("inicio.inc");
include("functions.php");
?>
<main>

    <?php
    if (isset($_GET['mail']) && $_GET['mail'] == 1) {

    ?>

        <script type="text/javascript">
            alert('Usuario, contraseña o repetir contraseña incorrectos');
        </script>

    <?php
    }
    ?>

    <section>
        <h2>Registro</h2>
        <div id="divForm" class="formuresponsive">
            <form action="respuestaRegistro.php" method="POST" enctype="multipart/form-data">
                <!-- Usuario con autofocus y obligatorio -->
                <div class="row">
                    <div class="col-25">
                        <label for="user">Usuario:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="user" name="user" placeholder="Pepe" autofocus>
                    </div>
                </div>

                <div class="row">
                    <!-- Contraseñas obligatorias -->
                    <div class="col-25">
                        <label for="password">Contraseña:</label>
                    </div>
                    <div class="col-75">
                        <input type="password" id="password" name="password" placeholder="tucontraseña">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="password2">Repetir contraseña:</label>
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
                            devPais();
                            ?>
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

                    <!-- <label for="foto"><br>Buscar Foto (< 51Kb): </label><input type="file" name="perfil"><br><br> -->
                </div><br>

                <input type="submit" value="Enviar" class="enviar" name="submit" />
            </form>
        </div>
    </section>

</main>
<?php
require_once("pie.inc");
?>