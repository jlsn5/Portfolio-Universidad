<?php
//session_start();
$title = "Prueba registro";
require_once("cabecera.php");
require_once("iniciolog.inc");
require_once("inicioBD.php");
include("functions.php");
?>

<main>

    <?php

        $nombre = $_POST["user"];
        $correo = $_POST["email"];
        $contra = $_POST["password"];
        $fecha = $_POST["fecha"];
        $ciudad = $_POST["ciudad"];
        // $perfil = $_FILES["perfil"];

        $usuactual = $_SESSION['name'];


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
            if($_FILES["perfil"]["error"] != 4){
                echo "Error: " . $msgError[$_FILES["perfil"]["error"]] . "<br />";
            }
            $_SESSION['fot'] = False;
        } else {

            $tam = ceil($_FILES["perfil"]["size"] / 1024);

            if ($tam <= 50) {
                if (file_exists("../img" . $_FILES["perfil"]["name"])) {
                    echo $_FILES["perfil"]["name"] . " ya existe";
                } else {
                    if (@move_uploaded_file($_FILES["perfil"]["tmp_name"], "C:/xampp/htdocs/picturefy/perfiles/" . $_FILES["perfil"]["name"])) {
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


        $paissi = $_POST['selectpais'];
            $sentenciapais = "SELECT * from paises where NomPais = '$paissi'";

        if(!($resultadopais = @mysqli_query($link, $sentenciapais))) {
            echo '<p>Error al ejecutar la sentencia <b>$sentenciapais</b>: ' . mysqli_error($link);
            echo'</p>';
            exit;
        }

        while($fila = mysqli_fetch_assoc($resultadopais))     { 
            $pais = $fila['IdPais'];           
        }
       
        $contra2 = $_POST["password2"];


        $boolUSU = false;
        // $vacioUSU = False;
        if($nombre == "")  $boolUSU= True;

        $patro = "/^[A-Za-z0-9]/";

        $patro0 = "/^[0-9]/";

        if(preg_match($patro, $nombre)){
            
            if(strlen($nombre)>2 && strlen($nombre)<16){        
                
                if(!(preg_match($patro0, $nombre[0]))){
                    $boolUSU=True;
                }
            }
        }




        $boolCON = False;
        //$vacioCON =False;
        if($contra== "") $boolCON=True;

        $patro1 = "/^[A-Za-z0-9-_]/";

        $mayus = "/^[A-Z]/";

        $minus = "/^[a-z]/";

        $num = "/^[0-9]/";

        

        $contmayus =0;
        $contminus=0;
        $contnum=0;

        if(preg_match($patro1, $contra)){
            
            if(strlen($contra)>5 && strlen($contra)<16){        
              

                for($i=0;$i<strlen($contra);$i++){
                    if(!(preg_match($mayus, $contra[$i])) && !(preg_match($minus, $contra[$i]))){
                        
                        $contmayus++;
                    }
                    if(!(preg_match($minus, $contra[$i])) && !(preg_match($num, $contra[$i]))){
                        
                        $contminus++;
                    }
                    if(!(preg_match($num, $contra[$i])) && !(preg_match($mayus, $contra[$i]))){
                        
                        $contnum++;              
                    }               
                    
                }

                if($contnum >0 && $contminus>0 && $contmayus>0){
                    $boolCON=True;
                }
            }
        }

        



        $boolCON2=False;


        //$vacioCON2=False;
        if($contra2== "") $boolCON2=True;

        if($contra2 == $contra){
            $boolCON2=True;
        }


        $bool = False;
        //$vacio=False;
        if($correo == "") $vacioEmal=True;

        $contador = 0;

        if(strpos($correo, '@')){
            $contador++;
        }

        if($contador==1){
            $bool=True;
        }


        if(strlen($correo)<255){

            if($bool==True){
                $spli = explode("@", $correo);

                $spliAux = $spli[0];

                if(strlen($spli[0]) < 1 || strlen($spli[1])  < 1 || strlen($spli[0])  > 64 || strlen($spli[1])  > 255){
                    $bool=False;
                }

                if($bool==True){
                    $patron = "/^[A-Za-z0-9Z#$%&'*+-=?^_`{|}~\\/]./";
                    $patronito = "/^[A-Za-z0-9-.]/";

                    if(!(preg_match($patron, $spli[0]))){
                        $bool=False;
                    }

                    if(!(preg_match($patronito, $spli[1]))){
                        $bool=False;
                    }
                }

                if($bool==True){
                    if($spli[0][0] =='.'){
                        $bool=False;    
                    }
                    // if($spli[0][strlen($contra)-1] =='.'){
                    //    $bool=False;
                    // }           
                }

                if($bool==True){
                    for($k=0; $k<strlen($spli[0])-1;$k++){
                        if($spli[0][$k] == '.' && $spli[0][$k+1] == '.'){
                           $bool=False;
                            break;
                        } 
                    }
                }


                if($bool==True){
                    if(strpos($spli[1], '.')){
                        
                        $spl = explode(".", $spli[1]);

                        $patro = "/^[A-Za-z0-9-.]/";

                        for($j=0; $j<count($spl)-1;$j++){
                            if(strlen($spl[$j]) >63){
                               $bool=False;
                                break;  
                            }               
                        }


                            for($j=0; $j<count($spl);$j++){

                                if(!(empty($spl))){
                                    if ($spl[$j][0] == '-') {
                                        $bool = False;
                                        break;
                                    }
                                    if ($spl[$j][strlen($spl[$j]) - 1] == '-') {
                                        $bool = False;
                                        break;
                                    }
                                }
                            }
                    }
                    else{
                        $bool=False;
                    }
                }
            }
        }
        else{
             $bool=False;
        }
    
        

            
        $html='';
        
          
        echo "<article class='detalle'>";
        echo '<h2>Registro</h2>';

        if( isset($_POST['selectpais'])){
            $sql = " UPDATE usuarios SET Pais='$pais' WHERE NomUsuario='$usuactual' ";
        }

        if(isset($sql) && mysqli_query($link, $sql)){
            echo "<p> Has actualizado el pais (se actualiza siempre porque siempre hay uno elegido). </p>";

        } else if(isset($sql)){
            echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
        }

        if(isset($_POST['ciudad'])  && !(empty($_POST['ciudad']))){
            $sql2 = "UPDATE usuarios SET Ciudad='$ciudad' WHERE NomUsuario='$usuactual'";
        }

        if(isset($sql2) && mysqli_query($link, $sql2)){
            echo "<p> Has actualizado la ciudad. </p>";

        } else if(isset($sql2)){
            echo "ERROR: No se ejecuto $sql2. " . mysqli_error($link);
        }

        if($vacioEmal==True || $bool == True){
            if(isset($_POST['email']) && !(empty($_POST['email']))){
                $sql3 = "UPDATE usuarios SET Email='$correo' WHERE NomUsuario='$usuactual'";
            }

            if(isset($sql3) && mysqli_query($link, $sql3)){
                echo "<p> Has actualizado el email. </p>";

            } else if (isset($sql3)) {
                echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
            }
        }else{
            echo '<p> El email es incorrecto .</p>';
        }
        

        if( isset($_POST['fecha']) && !(empty($_POST['fecha'])) ){
            $sql4 = "UPDATE usuarios SET Fecha='$fecha' WHERE NomUsuario='$usuactual'";
        }

        if(isset($sql4) && mysqli_query($link, $sql4)){
            echo "<p> Has actualizado la fecha. </p>";

        } else if (isset($sql4)) {
            echo "ERROR: No se ejecuto $sql. " . mysqli_error($link);
        }

        if($boolUSU == True){
            if(isset($_POST['user']) && !(empty($_POST['user']))){
                $sql5 = "UPDATE usuarios SET NomUsuario='$nombre' WHERE NomUsuario='$usuactual'";
            }

            if(isset($sql5) && mysqli_query($link, $sql5)){
                echo "<p> Has actualizado el nombre de usuario. </p>";

            } else if(isset($sql5)){
                echo "ERROR: No se ejecuto $sql5. " . mysqli_error($link);
            }
        }else{
            echo '<p> El nombre de usuario es incorrecto </p>';
        }


        if ($boolCON == True && $boolCON2 == True) {
            if (isset($_POST['password']) && !(empty($_POST['password']))) {
                $sql6 = "UPDATE usuarios SET Clave='$contra' WHERE NomUsuario='$usuactual'";
            }

            if (isset($sql6) && mysqli_query($link, $sql6)) {
                echo "<p> Has actualizado la contraseña. </p>";
            } else if (isset($sql6)) {
            echo "ERROR: No se ejecuto $sql6. " . mysqli_error($link);
            }
        } else {
            echo '<p> La nueva contraseña es incorrecta </p>';
        }


        if ($_SESSION['fot'] != False) {
            $fiche = "../perfiles/" . $_FILES["perfil"]["name"];

            
            $sql7 = "UPDATE usuarios SET Foto='$fiche' WHERE NomUsuario='$usuactual'";
            

            if (isset($sql7) && mysqli_query($link, $sql7)) {
                echo "<p> Has actualizado la foto de perfil. </p>";
            } else if (isset($sql7)) {
            echo "ERROR: No se ejecuto $sql7. " . mysqli_error($link);
            }
        }

        echo '</article>';   

    ?>
</main>

</section>

<?php
require_once("pie.inc");
?>
