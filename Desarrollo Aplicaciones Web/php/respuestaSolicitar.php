<?php
session_start();
$title = "Solicitar";
require_once("cabecera.php");
require_once("inicioLog.inc");
require_once("inicioBD.php");
include("functions.php");
?>

<main>

    <?php

    if (isset($_SESSION['acceso'])) {
        $usuactual = $_SESSION['name'];
        $yalb = "";

        $nom = $_GET["nombre"];
        $tit = $_GET["titulo"];
        $adi = $_GET["adicional"];
        $correo = $_GET["email"];
        $calle = $_GET["calle"];
        $num = $_GET["numero"];
        $cp = $_GET["cp"];
        $loc = $_GET["localidad"];
        $prov = $_GET["provincia"];
        $pais = $_GET["pais"];
        $tel = $_GET["telefono"];
        $color = $_GET["colorportada"];
        $numeropaginas = $_GET["numerocopias"];
        $res = $_GET["resolucion"];
        $album = $_GET["album"];
        $fecha = $_GET["fecha"];
        $icolor = 0;
        if (isset($_GET["impresion"])) {
            $icolor = 1;
        }

        //Sacar id del album a partir del nombre que recibimos

        $sentencia0 = "SELECT * from albumes where Titulo = '$album'";

        if (!($resultadousu = @mysqli_query($link, $sentencia0))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia0</b>: ' . mysqli_error($link);
            echo '</p>';
            exit;
        }

        while ($fila = mysqli_fetch_assoc($resultadousu)) {
            $yalb = $fila['IdAlbum'];
        }


        //Juntar direccion

        $direccion = $calle . ',' . $num . ',' . $cp . ',' . $loc . ',' . $prov . ',' . $pais . ',' . $tel;


        //Calcular el precio total de la pagina

        //$numeropaginas = 20;
        $preciototal = 0;

        //Depende del numero de paginas
        if ($numeropaginas < 5) {
            $preciototal = $numeropaginas * 0.1;
        } else if ($numeropaginas >= 5 && $numeropaginas <= 11) {
            $preciototal = $numeropaginas * 0.08;
        } else {
            $preciototal = $numeropaginas * 0.07;
        }

        //Depende si impresion a color o no
        if (isset($_GET["impresion"])) {
            $preciototal += ($numeropaginas * 0.05);
        }

        //Depende de los dpi
        if ($_GET["resolucion"] > 301) {
            $preciototal += ($numeropaginas * 0.02);
        }

        if (empty($nom) || empty($tit) || empty($correo) || empty($calle) || empty($num) || empty($cp) || empty($album)) {
            echo "<p>Campo obligatorio sin completar.</p>";
        } else {

            $sentencia = "INSERT INTO solicitudes (Album,Nombre,Titulo,Descripcion,Email,Direccion,Color,Copias,Resolucion,Fecha,IColor,Coste) VALUES ('$yalb', '$nom', '$tit', '$adi', '$correo', '$direccion', '$color', '$numeropaginas', '$res', '$fecha', '$icolor', '$preciototal')";

            if (!(mysqli_query($link, $sentencia))) {
                echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                echo '</p>';
                exit;
            } else {
                ?>
                    <section>
                        <h2>Álbum solicitado</h2>
                        <p>El siguiente álbum se ha solicitado: </p>
                        <ul>
                            <li>Nombre: <?php echo $_GET["nombre"]; ?></li>
                            <li>Título del álbum: <?php echo $_GET["titulo"]; ?></li>
                            <li>Texto adicional: <?php echo $_GET["adicional"]; ?></li>
                            <li>Correo electrónico: <?php echo $_GET["email"]; ?></li>
                            <li>Dirección: <?php echo $_GET["calle"]; ?>, <?php echo $_GET["numero"]; ?>, <?php echo $_GET["cp"]; ?></li>
                            <li>Localidad: <?php echo $_GET["localidad"]; ?>, <?php echo $_GET["provincia"]; ?>, <?php echo $_GET["pais"]; ?></li>
                            <li>Telefono: <?php echo $_GET["telefono"]; ?></li>
                            <li>Color de portada: <?php echo $_GET["colorportada"]; ?></li>
                            <li>Número de copias: <?php echo $_GET["numerocopias"]; ?></li>
                            <li>Resolución de las fotos: <?php echo $_GET["resolucion"]; ?></li>
                            <li>Álbum de fotos en el que se basa: <?php echo $_GET["album"]; ?></li>
                            <li>Fecha de recepción: <?php echo $_GET["fecha"]; ?></li>
                            <li>Impresión a color:
                                <?php
                                if (isset($_GET["impresion"])) {
                                    echo 'si';
                                } else {
                                    echo 'no';
                                }
                                ?></li>
                            <li>Coste total: <?php echo $preciototal; ?></li>
                        </ul>
                    </section>
                <?php
            }
        }
    } else {
        header("Location: ../php/index.php?mail=3");
    }

    ?>
</main>

<?php
require_once("pie.inc");
?>