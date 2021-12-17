<?php
@ob_start();
session_start();
$title = "Añadir mis fotos";
require_once("cabecera.php");
require_once("iniciolog.inc");
require_once("inicioBD.php");
include("functions.php");
?>
<main>

    <?php
    if (isset($_SESSION['acceso'])) {
        $usuactual = $_SESSION['name'];
    ?>

        <section>
            <h2>Añadir foto a álbum</h2>
            <div id="divForm" class="formuresponsive">
                <form action="insertarfotos.php" method="POST" enctype="multipart/form-data">
                    <!-- titulo -->
                    <div class="row">
                        <div class="col-25">
                            <label for="titulo">Titulo:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="titulo" name="titulo" placeholder="Fiordos" autofocus>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Descripcion -->
                        <div class="col-25">
                            <label for="descripcion">Descripcion:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="descripcion" name="descripcion" placeholder="Aquí descripcion">
                        </div>
                    </div>

                    <div class="row">
                        <!-- fecha -->
                        <div class="col-25">
                            <label for="fecha">Fecha:</label>
                        </div>
                        <div class="col-75">
                            <input type="date" id="fecha" name="fecha">
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

                    <!-- Foto  -->
                    <div class="row">
                        <div class="col-25">
                            <label for="foto">Foto: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="file" id="foto" name="perfil" accept="image/png,image/jpeg"><br>
                        </div>
                    </div><br>

                    <div class="row">
                        <!-- alt -->
                        <div class="col-25">
                            <label for="alternativo">Texto alternativo:</label>
                        </div>
                        <div class="col-75">
                            <input type="text" id="alternativo" name="alternativo" placeholder="Aquí texto alternativo">
                        </div>
                    </div>

                    <!-- Albumes -->
                    <div class="row">
                        <div class="col-25">
                            <label for="album">Álbum de PI<span>(*)</span>: </label>
                        </div>
                        <div class="col-75">
                            <select name="album" id="album">

                                <?php
                                $corta = $_SERVER['REQUEST_URI'];

                                list($noimporta, $importa) = explode("?", $corta);

                                $sentencia = "SELECT * FROM albumes ORDER BY albumes.Titulo ASC";

                                if (!($resultado = @mysqli_query($link, $sentencia))) {
                                    echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                                    echo '</p>';
                                    exit;
                                }

                                echo '<p>' . $importa . '</p>';
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    if ($fila['Titulo'] == $importa) {
                                        echo "<option selected>" .  $fila['Titulo'] . "</option>";
                                    } else {
                                        echo "<option>" .  $fila['Titulo'] . "</option>";
                                    }
                                }

                                ?>
                                <!-- <option value="Paisajes">Paisajes</option>
                            <option value="Fotos colores">Fotos colores</option> -->
                            </select>
                        </div>
                    </div>


                    <input type="submit" value="Enviar" class="enviar" name="submitanya">
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