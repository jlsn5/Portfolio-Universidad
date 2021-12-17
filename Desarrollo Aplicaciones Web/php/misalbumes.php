<?php
session_start();
$title = "Mis Albumes";
require_once("cabecera.php");
require_once("inicioLog.inc");
require_once("inicioBD.php");
?>

<?php
    if( isset($_SESSION['acceso']) ){
        $usuactual = $_SESSION['name'];
?>

<main>

    <h1>Mis álbumes</h1>

    <div>

        <?php

        $sentencia = "SELECT * FROM usuarios";

        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }
    
        $idi = "cosa";
    
        while($fila = mysqli_fetch_assoc($resultado))     {
             if($fila['NomUsuario'] == $_SESSION["name"]){
                $idi = $fila['IdUsuario'];
                break;
             }
        }



        $sentencia2 = "SELECT * FROM albumes WHERE Usuario = {$idi}";

        if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila2 = mysqli_fetch_assoc($resultado2)){
            echo "<div class='img-container'>";
            $tit = $fila2['Titulo'];
            echo "<a href='verAlbumPriv.php?$tit'><h3> <strong>" .  $fila2['Titulo'] . "</strong></h3></a>"; 
            echo "<p> " .  $fila2['Descripcion'] . "</p>";       
            echo "<br>";
            //echo "<button onclick="window.location.href='/page2'"></button>";
            echo "</div>";
        }

        ?>
    </div>

    <?php
    }else{
        header("Location: ../php/index.php?mail=3");
    }
    ?>

</main>

<?php
require_once("pie.inc");
?>