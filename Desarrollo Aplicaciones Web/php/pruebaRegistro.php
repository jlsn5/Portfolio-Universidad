<?php
$title = "Prueba registro";
require_once("cabecera.php");
require_once("inicio.inc");
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
                if (file_exists("../perfiles" . $_FILES["perfil"]["name"])) {
                    echo $_FILES["perfil"]["name"] . " ya existe";
                    $_SESSION['fot'] = False;
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

        $vacioUSU = False;
        if($nombre == "")  $vacioUSU= True;

        $patro = "/^[A-Za-z0-9]/";

        $patro0 = "/^[0-9]/";

        $boolUSU=false;

        if(preg_match($patro, $nombre)){
            
            if(strlen($nombre)>2 && strlen($nombre)<16){        
                
                if(!(preg_match($patro0, $nombre[0]))){
                    $boolUSU=True;
                }
            }
        }

        


        
        $vacioCON =False;
        if($contra== "") $vacioCON=True;

        $patro1 = "/^[A-Za-z0-9-_]/";

        $mayus = "/^[A-Z]/";

        $minus = "/^[a-z]/";

        $num = "/^[0-9]/";

        $boolCON=False;

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


        $vacioCON2=False;
        if($contra2== "") $vacioCON2=True;

        if($contra2 == $contra){
            $boolCON2=True;
        }
      
       
        $vacio=False;
        if($correo == "") $vacio=True;

        $contador = 0;

        $bool = False;


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
        
        if($bool==True && $boolUSU==True && $boolCON==True && $boolCON2==True /*&& $boolRAD==True*/) {

            $encriptacionSHAl = sha1($contra);


            if ($_SESSION['fot'] != False) {

                $fiche = "../perfiles/".$_FILES["perfil"]["name"];


                $sentencia = "INSERT INTO usuarios (NomUsuario,Clave,Email,FNacimiento,Ciudad,Pais,Foto,Estilo) VALUES ('$nombre', '$encriptacionSHAl', '$correo','$fecha','$ciudad','$pais','$fiche' ,1)";
          

                if(!(mysqli_query($link, $sentencia))) {
                    echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
                    echo'</p>';
                    exit;
                }
                else{
                    echo "<article class='detalle'>";
                    echo "<h3>Inserción realizada, el nuevo usuario tiene los datos: </h3>";
                    echo "<p>Nombre del usuario: <strong>" . $nombre . "</strong></p>";
                    echo "<p>Email: <strong>" . $correo . "</strong></p>";
                    //echo "<p>Sexo: <strong>" . $sexo . "</strong></p>";
                    echo "<p>Fecha de nacimiento: <strong>" . $fecha . "</strong></p>";
                    echo "<p>Ciudad: <strong>" . $ciudad . "</strong></p>";
                    echo "<p>Pais: <strong>" . $pais . "</strong></p>";
                    
                    //ENSEÑAR FOTO
                    echo "<p>Foto:</p><br>";
                    echo "<img src=" . $fiche .">" ;
                    // C:/xampp/htdocs/picturefy/img/" . $_FILES["perfil"]["name"]
                    

                    echo "</article>";
                }
            } else {
                echo "<p>Fallo con la foto</p>";
            }
        }
        else{


            
            echo "<article class='detalle'>";
            echo '<h2>Registro</h2>';
            echo '<p>ERRORES:</p>';

            if($boolUSU==False){
                if($vacioUSU==True){
                    echo '<p> El nombre de usuario esta vacio </p>';
                }
                else{
                    echo '<p> El nombre de usuario es incorrecto </p>';
                }
            }
            if($boolCON==False){
                if($vacioCON==True){
                   echo '<p> La contraseña esta vacia </p>';
                }
                else{
                    echo '<p> La contraseña es incorrecta </p>';
                }
            }
            if($boolCON2==False){
                if($vacioCON2==True){
                    echo '<p> La segunda contraseña esta vacia </p>';
                }
                else{
                    echo '<p> La contraseña no coincide con la anterior </p>';
                }
            }
            
            if($bool==False){
                if($vacio==True){
                    echo '<p> El email esta vacio </p>';
                }
                else{
                    echo '<p> El email es incorrecto </p>';
                }
            }/*
            if(boolRAD===false){
                html += '<p> El campo de sexo esta vacio </p>';
            }

            */
            echo '</article>';

                
            
            }
        //}
         
    
?>
</main>

</section>

<?php
require_once("pie.inc");
?>