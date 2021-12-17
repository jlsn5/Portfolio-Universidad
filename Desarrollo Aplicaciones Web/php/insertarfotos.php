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
    
                $band = true;
                $band1 = true;

                $titulo = $_POST["titulo"];
                $descripcion = $_POST["descripcion"];
                $alternativo = $_POST["alternativo"];
                $album = $_POST["album"];
                $fecha = $_POST["fecha"];
                $pais = $_POST["selectpais"];
    
                if(isset($_POST['submitanya'])){
                    if( (empty($_POST['titulo'])) ){
                        $band = False;
                    }

                    if( (empty($_POST['alternativo'])) || strlen($alternativo)  < 10 ){
                        $band1 = false;
                    }
                }else{
                    $band = False;
                    $band1 = False;
                }

                //FOTO

                            $_SESSION['fot'] = True;

                            $msgError = array(
                                0 => "No hay error, el fichero se subió con éxito",
                                1 => "El tamaño del fichero supera la directiva
                                                            upload_max_filesize el php.ini",
                                2 => "El tamaño del fichero supera la directiva
                                                            MAX_FILE_SIZE especificada en el formulario HTML",
                                3 => "El fichero fue parcialmente subido",
                                4 => "No se ha subido un fichero",
                                6 => "No existe un directorio temporal",
                                7 => "Fallo al escribir el fichero al disco",
                                8 => "La subida del fichero fue detenida por la extensión"
                            );


                            if ($_FILES["perfil"]["error"] > 0) {
                                echo "Error: " . $msgError[$_FILES["perfil"]["error"]] . "<br />";
                                $_SESSION['fot'] = False;
                            } else {

                                $tam = ceil($_FILES["perfil"]["size"] / 1024);

                                if ($tam <= 50) {
                                    if (file_exists("../img/" . $_FILES["perfil"]["name"])) {
                                        echo $_FILES["perfil"]["name"] . " ya existe";
                                        $_SESSION['fot'] = False;
                                    } else {
                                        if (@move_uploaded_file($_FILES["perfil"]["tmp_name"], "C:/xampp/htdocs/picturefy/img/" . $_FILES["perfil"]["name"])) {
                                            //echo "Todo bien";
                                        } else {
                                            echo "Algo mal";
                                            $_SESSION['fot'] = False;
                                        }
                                    }
                                } else {
                                    echo "Tamaño de la foto: " . ceil($_FILES["perfil"]["size"] / 1024) . " Kb<br />";
                                    echo "La imagen debe pesar menos de 50Kb";
                                    $_SESSION['fot'] = False;
                                }
                            }



                if($band == false && $band1 == false){
                    echo "<p>Falta poner un titulo</p>";
                    echo "<br>";
                    echo "<p>Texto alternativo tiene que ser mayor que 10 caracteres</p>";
                }else{

                    $sentenciapais = "SELECT * from paises where NomPais = '$pais'";

                    if(!($resultadopais = @mysqli_query($link, $sentenciapais))) {
                        echo '<p>Error al ejecutar la sentencia <b>$sentenciapais</b>: ' . mysqli_error($link);
                        echo'</p>';
                        exit;
                    }

                    while($fila = mysqli_fetch_assoc($resultadopais))     { 
                        $paisito = $fila['IdPais'];           
                    }

                    


                    $sentenciaalbum = "SELECT * from albumes where Titulo = '$album'";

                    if(!($resultadoalbum = @mysqli_query($link, $sentenciaalbum))) {
                        echo '<p>Error al ejecutar la sentencia <b>$sentenciaalbum</b>: ' . mysqli_error($link);
                        echo'</p>';
                        exit;
                    }

                    while($fila2 = mysqli_fetch_assoc($resultadoalbum))     { 
                        $albumito = $fila2['IdAlbum'];          
                    }

                    if ($_SESSION['fot'] != False) {
                    
                        $fiche ="\'" . "../img/".$_FILES["perfil"]["name"] . "\'" ;

                        

                        $sentencia = "INSERT INTO fotos (IdFoto,Titulo,Descripcion,Fecha,Pais,Album,Fichero,Alternativo,FRegistro) VALUES ('','$titulo', '$descripcion', '$fecha', '$paisito' , '$albumito','$fiche', '$alternativo', now())";
                

                        if(!(mysqli_query($link, $sentencia))) {
                            echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                            echo'</p>';
                            exit;
                        }
                        else{

                        // $titulobueno = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_HIGH);
                            $titulobueno = filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);
                            echo "<h3>Inserción realizada, la nueva foto es: </h3>";
                            echo "<p>Titulo: <strong>" . $titulobueno . "</strong></p>";
                            echo "<p>Descripcion: <strong>" . $descripcion . "</strong></p>";
                            echo "<p>Fecha: <strong>" . $fecha . "</strong></p>";
                            echo "<p>Pais: <strong>" . $pais . "</strong></p>";            
                            echo "<p>Album: <strong>" . $album . "</strong></p>";
                        }
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