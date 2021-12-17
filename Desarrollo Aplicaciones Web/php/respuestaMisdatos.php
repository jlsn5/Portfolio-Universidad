<?php
session_start();
$title = "Solicitar";
require_once("cabecera.php");
require_once("inicioLog.inc");
?>

<main>

    <?php
    $_SESSION['actu'] = True;
    include("pruebaMisDatos.php");
    ?>

</main>

<?php
require_once("pie.inc");
?>