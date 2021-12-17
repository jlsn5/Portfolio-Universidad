<?php
@ob_start();
session_start();
$title = "Insertar fotos";
require_once("cabecera.php");
require_once("iniciolog.inc");
require_once("inicioBD.php");
include("functions.php");
?>
    
    <main>

    <?php
        if( isset($_SESSION['acceso']) ){
            $usuactual = $_SESSION['name'];
    ?>

    <section>

    		<br><br><h2>¿Estas seguro que quieres eliminar tu cuenta? Teniendo:</h2><br>
    <?php


    $cook = $_SESSION["name"];

    $sentencia = "SELECT * FROM albumes where Usuario = (Select idUsuario from usuarios where NomUsuario = '$cook')";


    if(!($resultado = @mysqli_query($link, $sentencia))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo'</p>';
        exit;
    }

    $idi = "Hamburguesa";

    while($fila = mysqli_fetch_assoc($resultado))     {
            $idi = $fila['IdAlbum'];
            echo "<br><br>";
            echo "<h2>El album: </h2>";
            echo "<article class='detalle'>";
            echo "<h3> <strong>" .  $fila['Titulo'] . "</strong></h3>"; 
            echo "<h3> <strong>" .  $fila['Descripcion'] . "</strong></h3>"; 
            echo "</article>";

             $sentencia2 = "SELECT * FROM fotos WHERE Album= {$idi}";


        if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

       
        
        echo "</section>";
        echo "<section>";
        



        $sentencia2 = "SELECT * FROM fotos WHERE Album= {$idi}";

          if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        $sentenciatotal = "SELECT COUNT(*) total FROM fotos WHERE Album= {$idi}";

        // $urlfoto = "SELECT Titulo FROM fotos WHERE Album= {$idi}";

        // $result2 = mysqli_query($link,$sentenciatotal);

        // unlink($result2);//acá le damos la direccion exacta del archivo


        $result = mysqli_query($link,$sentenciatotal);
        $numero = mysqli_fetch_assoc($result);

        if($numero['total']>=1){
            echo "<h2>Con fotos: </h2>";
        }



         while($fila2 = mysqli_fetch_assoc($resultado2)){     
            
            echo "<article class='detalle'>";
            echo "<h3> <strong>" .  $fila2['Titulo'] . "</strong></h3>"; 
            echo "<img src=" .$fila2['Fichero']. "weight='200' height='144'" .$fila2['Alternativo']. ">"; 
            echo "<h3> <strong>" .  $fila2['Descripcion'] . "</strong></h3>"; 
            echo "<h3> <strong>" .  $fila2['Fecha'] . "</strong></h3>";      
            echo "</article>";
        } 
        
    } 

  

   

?>
    
        <form action="borrado.php" method="POST">
            <br><input id="rojo" type="submit" value="Cancelar el borrado" name="cancelar"> <br> 
            <br><label>Para continuar con el borrado ponga su contraseña: <tr><input type="password" id="cont" name="contra"></label><br>   
            <br><input id="verde" type="submit" value="Continuar con el borrado" name="aceptar"><br>
        </form>
         
  

    </section>
	  

    <?php
    }else{
        header("Location: ../php/index.php?mail=3");
    }
    ?>
    </main>
      

<?php
require_once("pie.inc");
?>