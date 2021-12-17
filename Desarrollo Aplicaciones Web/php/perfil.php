<?php
session_start();
$title = "Perfil";
require_once("cabecera.php");
require_once("inicio.inc");
require_once("inicioBD.php");
?>

<main>

    <h1>Perfil</h1>
    <h2>Detalles del usuario</h2>
    <div>
        
        <?php

        $corta = $_SERVER['REQUEST_URI'];

        list($noimporta, $importa) = explode("?", $corta);
    
        $sentencia = "SELECT * FROM usuarios";

        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila = mysqli_fetch_assoc($resultado))     {
            if( $fila['NomUsuario'] == ( $importa ) ){
                $idi = $fila['IdUsuario'];
                echo "<div class='img-container'>";
                echo "<h3><strong>" .  $fila['NomUsuario'] . "</strong></h3>"; 
                echo "<img src=" .$fila['Foto']. ">"; 
                echo "<p>Fecha de incorporación : <strong>" .  $fila['FRegistro'] . "</strong></p>";
                echo "</div>";  
            }    
        }

        ?>
    </div>

    <div>
        <h2>Lista de álbumes</h2>

        <?php

        $sentencia = "SELECT * FROM albumes WHERE Usuario = {$idi}";

        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        echo '<ul>';
        while($fila = mysqli_fetch_assoc($resultado))     {
                $idi = $fila['IdAlbum'];
                echo "<li>";
                echo  $fila['Titulo'] ; 
                echo "</li>";            
        }
        echo '</ul>';

        ?>
    </div>

</main>

<?php
require_once("pie.inc");
?>