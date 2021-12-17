<?php
// Título de la página, se muestra en <title> y en el cuerpo de la página con <h2>
$title = "Pruebas";
// Declaración de DOCTYPE, <html>, <head>, <meta>, <link>, etc.
/* Contiene <title><?php echo $title; ?></title>*/
require_once("cabecera.inc");
// Inicio de la página
// Contiene <body>
// Muestra logotipo, título del sitio web, barra de navegación principal,
// cuadro de buscar, etc.
/* Contiene <h2><?php echo $title; ?></h2>, con <h1> está marcado el título*/
// del sitio web
require_once("inicio.inc");
// Acceso a la parte privada de la aplicación (login)
// Sólo aparece en la página principal
require_once("acceso.inc");
// El contenido principal de la página
?>
<main>
    <p>Esto cambia</p>
</main>
 <?php
// El pie de la página: copyright, declaración legal, dirección de correo, etc.
// Contiene </body></html>
require_once("pie.inc");
?>