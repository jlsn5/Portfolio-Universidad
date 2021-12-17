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
	    $cook = $_SESSION["name"];

	    $sentencia = "SELECT * FROM usuarios where NomUsuario = '$cook'";


	    if(!($resultado = @mysqli_query($link, $sentencia))) {
	        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
	        echo'</p>';
	        exit;
	    }

		if(isset($_POST['cancelar'])){
			$host = $_SERVER['HTTP_HOST'];
		    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		    $extra ='indexlog.php';
		    header("Location: http://$host$uri/$extra");
		    exit;
		}else{

			 while($fila = mysqli_fetch_assoc($resultado))     {
				$desencriptacionSHAl = sha1($_POST['contra']);
				if($desencriptacionSHAl != $fila['Clave']){
					echo "<h3>Contraseña incorrecta</h3>";
					break;
				}
				else{
					$consulta = "DELETE FROM usuarios WHERE  NomUsuario = '$cook'";

					if(mysqli_query($link, $consulta)){
					    $host = $_SERVER['HTTP_HOST'];
					    $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
					    $extra ='salir.php';
					    header("Location: http://$host$uri/$extra");
					    exit;
					} else{
					    echo "ERROR: No se pudo eliminar registro $consulta. " . mysqli_error($link);
					}
				}
			}
		}
        ?>
    </main>
      

<?php
require_once("pie.inc");
?>