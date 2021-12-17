<?php
session_start();
$title = "Crear Album";
require_once("cabecera.php");
require_once("inicioLog.inc");
?>
<main>
    <!-- Codigo html -->
    <section>
        <h2>Crear Álbum</h2>
        <div id="divForm" class="formuresponsive">
            <form action="insertarAlbum.php" method="POST">
                <div class="row">
                    <div class="col-25">
                        <label for="title">Título:</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="title" name="titulo" placeholder="Mona Lisa">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <label for="descripcion">Descripcion: </label><br>
                    </div>
                    <div class="col-75">
                        <textarea name="descripcion" id="descripcion" placeholder="Esto es una descripcion" class="comment"></textarea>
                        <!-- <input type="text" id="descripcion" name="descripcion"> -->
                    </div>
                </div>

                <input type="submit" class="enviar" value="Enviar" name="submitalb" />
            </form>
        </div>
    </section>

</main>
<?php
require_once("pie.inc");
?>