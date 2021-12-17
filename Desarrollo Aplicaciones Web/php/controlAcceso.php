<?php

session_start();

require_once("inicioBD.php");

$sentencia = "SELECT * FROM usuarios";


if (!($resultado = @mysqli_query($link, $sentencia))) {
    echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
    echo '</p>';
    exit;
}

$filtro = false;

while ($fila = mysqli_fetch_assoc($resultado)) {

    $desencriptacionSHAl = sha1($_POST['password']);


    if (!(empty($_POST['user'])) && !(empty($desencriptacionSHAl))) {

        if (($_POST['user']) == ($fila['NomUsuario'])) {

            if (($desencriptacionSHAl) == ($fila['Clave'])) {

                $filtro = true;

                $_SESSION["logueado"] = "true";
                $_SESSION["name"] = $_POST["user"];
                $_SESSION['acceso'] = true;

                if (isset($_POST['save'])) {

                    $nombre = $_POST['user'];
                    $_SESSION['user'] = $nombre;

                    //$user = hash('sha256', $_POST["user"]);
                    $pass = hash('sha256', $_POST["password"]);

                    if (!isset($_COOKIE['usuario'])) {
                        setcookie('usuario', $nombre, time() + 90 * 24 * 60 * 60, "/", "", "", true);

                        setcookie('contrasena', $pass, time() + 90 * 24 * 60 * 60, "/", "", "", true);
                    }

                    setcookie("fechahora", date("d-m-Y H:i:s"), time() + 90 * 24 * 60 * 60, "/", "", "", true);
                }

                #redirección
                header("Location: ../php/indexlog.php");

                exit;
            }
        }
    }else{
        header("Location: ../php/index.php?mail=1");
        exit;
    }
}

if($filtro == false){
    header("Location: ../php/index.php?mail=1");
    exit;
}

?>