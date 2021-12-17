<?php
$title = "tablaPrecios";

//Si lo hago funcion, se rompe el footer y se pone abajo del tood
//De esta forma el footer se mantiene, aunque se pone arriba del todo

$nombre1   = "Adriana";
$apellido1 = "Ortiz";
$arr = array("Pedro", "Duarte");
$cont = 1;
$cont2 = 3;
$menor5 = 0.1;
$entre5y11 = 0.08;
$mas11 = 0.07;
$color = 0.05;
$mas300dpi = 0.02;
$numPag = 1;
$numPag2 = 1;
$numPag3 = 1;
$numPag4 = 1;
$numFoto = 3;
$numFoto2 = 3;
$numFoto3 = 3;

echo "<table>";
echo "<caption> Posibles costes de un álbum </caption>";

for ($f = 0; $f < 2; $f++) {
    echo "<tr>";
    for ($c = 0; $c < 6; $c++) {

        if (($f == 0 && $c == 0) || ($f == 0 && $c == 1) || ($f == 0 && $c == 3) || ($f == 0 && $c == 5)) {
            echo "<td></td>";
        }

        if ($f == 0 && $c == 2) {
            echo "<td> Blanco y negro </td>";
        }

        if ($f == 0 && $c == 4) {
            echo "<td> Color </td>";
        }

        if ($f == 1 && $c == 0) {
            echo "<td> Número de páginas </td>";
        }

        if ($f == 1 && $c == 1) {

            echo "<td> Número de fotos </td>";
        }

        if ($f == 1 && $c == 2) {

            echo "<td> 150-300 dpi </td>";
        }

        if ($f == 1 && $c == 3) {

            echo "<td> 450-900 dpi </td>";
        }

        if ($f == 1 && $c == 4) {

            echo "<td> 150-300 dpi </td>";
        }

        if ($f == 1 && $c == 5) {

            echo "<td> 450-900 dpi </td>";
        }
    }
}

for ($f = 2; $f < 17; $f++) {
    echo "<tr>";
    for ($c = 0; $c < 6; $c++) {

        if ($c < 1) {
            echo "<td> " . $cont . " </td>";

            $cont++;
        }

        if ($c == 1) {
            echo "<td> " . $cont2 . " </td>";

            $cont2++;
            $cont2++;
            $cont2++;
        }

        //Blanco y negro
        if ($c == 2 && $f < 6) {
            $socorro = $menor5 * $numPag;
            $socorro2 = number_format($socorro, 2);

            echo "<td> " . $socorro2 . " </td>";

            $numPag++;
        }

        if ($c == 2 && $f >= 6 && $f < 13) {
            $socorro = $menor5 * 4 + $entre5y11 * ($numPag - 4);
            $socorro2 = number_format($socorro, 2);
            echo "<td> " . $socorro2 . " </td>";
            $numPag++;
        }

        if ($c == 2 && $f >= 13) {
            echo "<td> " . number_format(($menor5 * 4 + $entre5y11 * 7 + $mas11 * ($numPag - 11)), 2) . " </td>";
            $numPag++;
        }

        //Blanco y negro, +300 dpi
        if ($c == 3 && $f < 6) {
            //var numPag = document.getElementById("tablaPrecios").rows[f].cells[c].innerText;
            $socorro = ($menor5 * $numPag2) + ($mas300dpi * $numFoto);
            $socorro2 = number_format($socorro, 2);
            echo "<td> " . $socorro2 . " </td>";

            $numPag2++;
            $numFoto++;
            $numFoto++;
            $numFoto++;
        }

        if ($c == 3 && $f >= 6 && $f < 13) {
            $socorro = $menor5 * 4 + $entre5y11 * ($numPag2 - 4) + ($mas300dpi * $numFoto);
            $socorro2 = number_format($socorro, 2);
            echo "<td> " . $socorro2 . " </td>";
            $numPag2++;
            $numFoto++;
            $numFoto++;
            $numFoto++;
        }

        if ($c == 3 && $f >= 13) {
            $socorro = $menor5 * 4 + $entre5y11 * 7 + $mas11 * ($numPag2 - 11) + ($mas300dpi * $numFoto);
            $socorro2 = number_format($socorro, 2);
            echo "<td> " . $socorro2 . " </td>";
            $numPag2++;
            $numFoto++;
            $numFoto++;
            $numFoto++;
        }

        //Color
        if ($c == 4 && $f < 6) {
            $socorro = ($menor5 * $numPag3) + ($color * $numFoto2);
            $socorro2 = number_format($socorro, 2);

            echo "<td> " . $socorro2 . " </td>";

            $numPag3++;
            $numFoto2++;
            $numFoto2++;
            $numFoto2++;
        }

        if ($c == 4 && $f >= 6 && $f < 13) {

            echo "<td> " . number_format(($menor5 * 4 + $entre5y11 * ($numPag3 - 4) + ($color * $numFoto2)), 2) . " </td>";

            $numPag3++;
            $numFoto2++;
            $numFoto2++;
            $numFoto2++;
        }

        if ($c == 4 && $f >= 13) {

            echo "<td> " . number_format(($menor5 * 4 + $entre5y11 * 7 + $mas11 * ($numPag3 - 11) + ($color * $numFoto2)), 2) . " </td>";

            $numPag3++;
            $numFoto2++;
            $numFoto2++;
            $numFoto2++;
        }

        //Color, +300 dpi
        if ($c == 5 && $f < 6) {

            echo "<td> " . number_format(($menor5 * $numPag4 + $color * $numFoto3 + $mas300dpi * $numFoto3), 2) . " </td>";

            $numPag4++;
            $numFoto3++;
            $numFoto3++;
            $numFoto3++;
        }

        if ($c == 5 && $f >= 6 && $f < 13) {

            echo "<td> " . number_format(($menor5 * 4 + $entre5y11 * ($numPag4 - 4) + $color * $numFoto3 + $mas300dpi * $numFoto3), 2) . " </td>";

            $numPag4++;
            $numFoto3++;
            $numFoto3++;
            $numFoto3++;
        }

        if ($c == 5 && $f >= 13) {

            echo "<td> " . number_format(($menor5 * 4 + $entre5y11 * 7 + $mas11 * ($numPag4 - 11) + $color * $numFoto3 + $mas300dpi * $numFoto3), 2) . " </td>";

            $numPag4++;
            $numFoto3++;
            $numFoto3++;
            $numFoto3++;
        }
    }
}

?>
