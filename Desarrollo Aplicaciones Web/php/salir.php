<?php
@ob_start();
session_start();
if(isset($_SESSION["name"])){ 
    session_destroy();
    setcookie("usuario", "", time() - 42000);
    setcookie("password", "", time() - 42000);
    setcookie("time", "", time() - 42000);
    setcookie("fechahora", "", time() - 42000);
}
?>

<main>
<h2>Desconectado : PI - Pictures & Images</h2>
<p><a href="index.php">Volver a inicio</a></p>
</main>

<?php
require_once("pie.inc");
?>