<?php
session_start();
$title = "Mis fotos";
require_once("cabecera.php");
require_once("inicioLog.inc");
?>

<?php
    if( isset($_SESSION['acceso']) ){
        $usuactual = $_SESSION['name'];
?>

<main>

    <h1>Mis Fotos</h1>

    <div>

        <?php

    
        $link = @mysqli_connect(
            'localhost',   // El servidor
            'root',     // El usuario
            '',            // La contraseña
            'pibd'
        ); // La base de datos

        if (!$link) {
            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
            echo '</p>';
            exit;
        } // Ejecuta una sentencia SQL


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

        while($fila2 = mysqli_fetch_assoc($resultado2))     {

        $albi = $fila2['Titulo'];
        
        $sentencia3 = "SELECT * FROM fotos WHERE Album = {$fila2['IdAlbum']}";

        if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia3</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila3 = mysqli_fetch_assoc($resultado3))     {
            echo "<div class='img-container'>";
            echo "<h3> <strong>" .  $fila3['Titulo'] . "</strong></h3>"; 
            echo "<img src=" .$fila3['Fichero']. "weight='200' height='144'" .$fila3['Alternativo']. ">"; 
            // echo "<h3> <strong>" .  $fila3['Titulo'] . "</strong></h3>"; 
            echo "<p>Album:<a href='VerAlbumPriv.php?$albi'> <strong> " .  $albi  . "</strong></p></a>"; 
            echo "</div>";

        }
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