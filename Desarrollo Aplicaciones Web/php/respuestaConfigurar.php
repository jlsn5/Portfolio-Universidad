<?php
@ob_start();
session_start();
$title = "Insertar fotos";
require_once("cabecera.php");
require_once("iniciolog.inc");
require_once("inicioBD.php");
include("functions.php");


$cook = $_SESSION["name"];

$respuesta = $_REQUEST['estilo'];

$sql = "UPDATE usuarios SET Estilo='$respuesta' WHERE NomUsuario='$cook'";

echo $cook;
echo "<br>";
echo $respuesta;
echo "<br>";

if (mysqli_query($link, $sql)) {

    echo "Estilo actualizado.";
} else {
    echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
}
?>
