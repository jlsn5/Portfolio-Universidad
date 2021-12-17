<?php
$title = "Busqueda";
require_once("cabecera.php");
require_once("inicio.inc");
require_once("inicioBD.php");
include("functions.php");
?>
<main>
    <section>
        <h2>Buscar</h2>
        <div id="divForm" class="formuresponsive">
            <form action="../php/resultadoBusqueda.php" method="GET">
                <div class="row">
                    <div class="col-25">
                        <label for="titulo">Título:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" name="titulo" placeholder="Mona Lisa">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="fechaini">Fecha Inicio: </label><br>
                    </div>
                    <div class="col-75">
                        <input type="date" id="fechaini" name="fechaini">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="fechafin">Fecha Fin: </label><br>
                    </div>
                    <div class="col-75">
                        <input type="date" id="fechafin" name="fechafin">
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

                <input type="submit" class="enviar" value="Enviar" />
            </form>
        </div>
    </section>
</main>
<?php
require_once("pie.inc");
?>