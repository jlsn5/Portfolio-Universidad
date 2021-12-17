<?php
$title = "Solicitar";
require_once("cabecera.php");
require_once("inicio.inc");
?>

<main>

    <section>
        <?php
        if (empty($_GET["titulo"]) && empty($_GET["fecha"]) && empty($_GET["selectpais"])) { ?>

            <h2>Búsqueda rápida</h2>
            <p>Parámetro: <?php echo $_GET["brapida"]; ?></p>

        <?php
        } else {
        ?>

            <h2>Búsqueda</h2>
            <p>Título: <?php echo $_GET["titulo"]; ?></p>
            <p>Fecha: <?php echo $_GET["fecha"]; ?></p>
            <p>País: <?php echo $_GET["selectpais"]; ?></p>

        <?php
        }
        ?>
    </section>

    <section>
        <h2>Ejemplo de resultado:</h2>


        <?php

        $link = @mysqli_connect(
            'localhost',   // El servidor
            'root',     // El usuario
            '',            // La contraseña
            'pibd'); // La base de datos

        if(!$link) {
            echo'<p>Error al conectar con la base de datos:'. mysqli_connect_error();
            echo'</p>';
            exit;
        }// Ejecuta una sentencia SQL


        $sentencia = "SELECT * FROM fotos";


        if(!($resultado = @mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila = mysqli_fetch_assoc($resultado))     { 

            // BUSQUEDA POR TITULO
            if( (($_GET['titulo']) == $fila['Titulo'] ) ){
                echo "<div class='img-container'>";
                echo "<h3><strong>" .  $fila['Titulo'] . "</strong></h3>"; 
                $tit = $fila['Titulo'];
                echo "<a href='detalle.php?$tit'><img src=" .$fila['Fichero']. "weight='200' height='144'" .$fila['Alternativo']. "></a>"; 
                echo "<p>Fecha: <strong>" .  $fila['Fecha'] . "</strong></p>";

                $paisin = $fila['Pais'];
                $sentenciain = "SELECT NomPais FROM paises WHERE IdPais = $paisin" ;
                $resultadoin = @mysqli_query($link, $sentenciain);     
                if(!($resultadoin = @mysqli_query($link, $sentenciain))) {
                    echo '<p>Error al ejecutar la sentencia <b>$sentenciain</b>: ' . mysqli_error($link);
                    echo'</p>';
                    exit;
                }
                while($filain = mysqli_fetch_assoc($resultadoin))     {        
                    echo "<p>Pais: <strong> " .   $filain['NomPais']  . "</strong></p>"; 
                }
                echo "</div>"; 
            }

            $paisito = "YOQUESE";

            $paisin = $fila['Pais'];
                $sentenciain = "SELECT NomPais FROM paises WHERE IdPais = $paisin" ;
                $resultadoin = @mysqli_query($link, $sentenciain);     
                if(!($resultadoin = @mysqli_query($link, $sentenciain))) {
                    echo '<p>Error al ejecutar la sentencia <b>$sentenciain</b>: ' . mysqli_error($link);
                    echo'</p>';
                    exit;
                }
                while($filain = mysqli_fetch_assoc($resultadoin))     {
                    if(($_GET['selectpais']) == $filain['NomPais']){
                        $paisito = $filain['NomPais'];	
                        break;		    
                    }       
                    
                }


            if(($_GET['selectpais']) == $paisito){
                echo "<div class='img-container'>";
                echo "<h3><strong>" .  $fila['Titulo'] . "</strong></h3>"; 
                    $tit = $fila['Titulo'];
                echo "<a href='detalle.php?$tit'><img src=" .$fila['Fichero']. "weight='200' height='144'" .$fila['Alternativo']. "></a>"; 
                echo "<p>Fecha: <strong>" .  $fila['Fecha'] . "</strong></p>";

                $paisin = $fila['Pais'];
                $sentenciain = "SELECT NomPais FROM paises WHERE IdPais = $paisin" ;
                $resultadoin = @mysqli_query($link, $sentenciain);     
                if(!($resultadoin = @mysqli_query($link, $sentenciain))) {
                    echo '<p>Error al ejecutar la sentencia <b>$sentenciain</b>: ' . mysqli_error($link);
                    echo'</p>';
                    exit;
                }
                while($filain = mysqli_fetch_assoc($resultadoin))     {        
                    echo "<p>Pais: <strong> " .   $filain['NomPais']  . "</strong></p>"; 
                }
                echo "</div>"; 
            }
        }
        ?>
    </section>
</main>

<?php
require_once("pie.inc");
?>