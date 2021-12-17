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

        <article>
            <?php
        $yusu = "";
        $band = True;

        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];


    if(isset($_POST['submitalb'])){
        if( (empty($_POST['titulo'])) ){
            $band = False;
        }   
    }
    else{
         $band = False;
    }


    if($band == False){
        echo "<p>Falta poner un titulo</p>";
    }
  
    else{        

        $cook = $_SESSION["name"];

        $sentenciausu = "SELECT * from usuarios where NomUsuario = '$cook'";

        if(!($resultadousu = @mysqli_query($link, $sentenciausu))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentenciausu</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila = mysqli_fetch_assoc($resultadousu)){ 
            $yusu= $fila['IdUsuario'];         
        }



        $sentencia = "INSERT INTO albumes (Titulo,Descripcion,Usuario) VALUES ('$titulo', '$descripcion', '$yusu')";
  

        if(!(mysqli_query($link, $sentencia))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }
        else{
            echo "<h3>Inserción realizada, el nuevo album es: </h3>";
            echo "<p>Titulo: <strong>" . $titulo . "</strong></p>";
            echo "<p>Descripcion: <strong>" . $descripcion . "</strong></p>";

            $sentencia = "SELECT * FROM albumes";


            if(!($resultado = @mysqli_query($link, $sentencia))) {
                echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                echo'</p>';
                exit;
            }

            $idi = "Hamburguesa";

            while($fila = mysqli_fetch_assoc($resultado))     {
                if($titulo == $fila['Titulo']){
                    $idi = $fila['IdAlbum'];
                    break; 
                }
            } 

            echo "<a href='AñadirFoto.php?$idi'> Añadir foto al album </a>";
        }
    }

    mysqli_close($link);
?>

        </article>
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