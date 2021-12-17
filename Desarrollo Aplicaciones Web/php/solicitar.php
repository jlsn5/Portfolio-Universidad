<?php
session_start();
$title = "Solicitar";
require_once("cabecera.php");
require_once("inicioLog.inc");
include 'tablaPrecios.php'; //Incluimos el archivo tablaPrecios para poder usar la función que contiene
include("functions.php");
?>

<main>
    <section>
        <h2>Solicitud de impresion de álbum</h2>
        <p>
            Mediante esta opción puedes solicitar la impresión y envio de uno de tus albumes a todo color, toda resolución. Presta atención al rellenar el siguiente formulario y una vez completado disfruta de tu álbum personalizado.
        </p>
    </section>

    <section>

        <div class="solicitar">
            <!-- <caption>Tarifas</caption> -->
            <!-- Si pongo caption no se aplica el diseño de la tabla, pero lo titulos de tabla se ponen con caption  -->
            <!-- Tabla de precios -->
            <table class="tarifas">
                <caption>Tarifas</caption>
                <tr>
                    <th>Concepto</th>
                    <th>Tarifa</th>
                </tr>
                <tr>
                    <td>&lt; 5 paginas</td>
                    <td>0.10€ por pág.</td>
                </tr>
                <tr>
                    <td>Entre 5 y 11 páginas</td>
                    <td>0.08€ por pág.</td>
                </tr>
                <tr>
                    <td>&gt; 11 paginas</td>
                    <td>0.07€ por pág.</td>
                </tr>
                <tr>
                    <td>Blanco y negro</td>
                    <td>0€</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>0.05€ por foto</td>
                </tr>
                <tr>
                    <td>Resolución &gt; 300 dpi</td>
                    <td>0.02€ por foto</td>
                </tr>
            </table>
        </div>
        <br>

        <div class="solicitar">
            <!-- Deberia ponerse aquí en medio entre la tabla de Tarifas y el formulario, pero se pone encima de ambas cosas -->
            <?php
            require_once("tablaPrecios.php");
            //tablaPrecios();
            ?>
        </div>

        <br>

        <div class="solicitar">

            <div id="divForm" class="formuresponsive">
                <form action="respuestaSolicitar.php" method="GET">
                    <!-- Nombre con autofocus y obligatorio y max 200 caracteres -->
                    <div class="row">
                        <div class="col-25">
                            <label for="nombre">Nombre y apellidos<span>(*)</span>:</label><br>
                        </div>
                        <div class="col-75">
                            <input type="text" id="nombre" name="nombre" placeholder="Su nombre" maxlength="200">
                        </div>
                    </div>

                    <!-- Titulo obligatorio y max 200 caracteres -->
                    <div class="row">
                        <div class="col-25">
                            <label for="titulo">Título del álbum<span>(*)</span>:</label><br>
                        </div>
                        <div class="col-75">
                            <input type="text" id="titulo" name="titulo" placeholder="Que lo describa " maxlength="200">
                        </div>
                    </div>

                    <!-- Texto adicional y max 4000 caracteres -->
                    <div class="row">
                        <div class="col-25">
                            <label for="adicional">Texto adicional:</label><br>
                        </div>
                        <div class="col-75">
                            <input type="text" id="adicional" name="adicional" placeholder="Descripción del contenido, dedicatoria..." maxlength="4000"><br>
                        </div>
                    </div>

                    <!-- Email obligatorio y max 200 caracteres -->
                    <div class="row">
                        <div class="col-25">
                            <label for="email">Email<span>(*)</span>: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="email" id="email" name="email" placeholder="pepe@gmail.com" maxlength="200">
                        </div>
                    </div>

                    <!-- Dirección -->
                    <div class="row">
                        <div class="col-25">
                            <label for="calle">Dirección<span>(*)</span>: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="text" id="calle" name="calle" placeholder="Calle">
                            <input type="text" name="numero" placeholder="Número">
                            <input type="text" name="cp" placeholder="CP">


                            <!-- Lista de localidades -->
                            <select name="localidad">
                            <option value="Novelda">Novelda</option>
                            <option value="Aspe">Aspe</option>
                            <option value="Monforte">Monforte</option>
                            <option value="San Vicente">San Vicente</option>
                        </select>

                            <!-- Lista de provincias -->
                            <select name="provincia">
                            <option value="Alicante">Alicante</option>
                            <option value="Valencia">Valencia</option>
                            <option value="Castellón">Castellón</option>
                        </select>

                            <select name="pais">
                            <option value="España">España</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Francia">Francia</option>
                        </select>
                        </div>
                    </div>

                    <!-- Número de teléfono -->
                    <div class="row">
                        <div class="col-25">
                            <label for="telefono">Teléfono: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="text" id="telefono" name="telefono" placeholder="666 66 66 66"><br>
                        </div>
                    </div>

                    <!-- Color de la portada -->
                    <div class="row">
                        <div class="col-25">
                            <label for="colorportada">Color de portada: </label>
                        </div>
                        <div class="col-75">
                            <input type="color" id="colorportada" name="colorportada"><br>
                        </div>
                    </div>

                    <!-- Numero de copias -->
                    <div class="row">
                        <div class="col-25">
                            <label for="numerocopias">Número de copias: </label>
                        </div>
                        <div class="col-75">
                            <input type="number" id="numerocopias" name="numerocopias" min="1" value="1"><br>
                        </div>
                    </div>

                    <!-- Resolución -->
                    <div class="row">
                        <div class="col-25">
                            <label for="resolucion">Resolución de impresión: </label>
                        </div>
                        <div class="col-75">
                            <select name="resolucion" id="resolucion">
                            <option value="150 dpi">150 dpi</option>
                            <option value="300 dpi">300 dpi</option>
                            <option value="450 dpi">450 dpi</option>
                            <option value="600 dpi">600 dpi</option>
                            <option value="750 dpi">750 dpi</option>
                            <option value="900 dpi">900 dpi</option>
                        </select><br>
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
                                devAlbum();
                            ?>
                            <!-- <option value="Paisajes">Paisajes</option>
                            <option value="Fotos colores">Fotos colores</option> -->
                        </select>
                        </div>
                    </div>

                    <!-- Fecha -->
                    <div class="row">
                        <div class="col-25">
                            <label for="fecha">Fecha recepción: </label><br>
                        </div>
                        <div class="col-75">
                            <input type="date" id="fecha" name="fecha"><br>
                        </div>
                    </div>

                    <!-- Impresion -->
                    <div class="row">
                        <div class="col-25">
                            <label for="impresion">¿Impresión a color?: </label>
                        </div>
                        <div class="col-75">
                            <input type="checkbox" name="impresion" id="impresion"><br>
                        </div>
                    </div>

                    <input type="submit" value="Enviar" class="enviar"><br>
                </form>
            </div>
        </div>
    </section>
</main>

<?php
require_once("pie.inc");
?>