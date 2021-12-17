<?php
@ob_start();
session_start();
$title = "Solicitar";
require_once("cabecera.php");
require_once("inicio.inc");
?>

<main>

    <?php

    #Validar formulario
    $validado1 = false;
    $validado2 = false;
    // Usuario y contraseña no vacios
    // if (!(empty($_POST['user'])) && !(empty($_POST['password']))) {
    //     // echo "El campo nombre está vacío"; 
    //     $validado1 = true;
    // }

    // if (($_POST['password']) == ($_POST['password2'])) {
    //     $validado2 = true;
    // }

    // if (!$validado1 || !$validado2) {
    //     #redirección
    //     header("Location: registro.php?mail=1");
    //     exit;
    // }

    include("pruebaRegistro.php");
    ?>

    <!-- <section>
        <h2>Registro</h2>
        <p>Inserción realizada, tus datos son: </p>
        <ul>
            <li>Nombre: <?php echo $_POST["user"]; ?></li>
            <li>Correo electrónico: <?php echo $_POST["email"]; ?></li>
            <li>Sexo: <?php echo $_POST["sexo"]; ?></li>
            <li>Fecha de nacimiento: <?php echo $_POST["fecha"]; ?></li>
            <li>Ciudad: <?php echo $_POST["ciudad"]; ?></li>
            <li>País: <?php echo $_POST["selectpais"]; ?></li>
        </ul>
    </section> -->

</main>

<?php
require_once("pie.inc");
?>