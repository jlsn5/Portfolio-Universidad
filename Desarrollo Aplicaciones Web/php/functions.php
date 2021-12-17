<?php

//Devolver pais
function devPais()
{
    $link = @mysqli_connect(
        'localhost',   // El servidor
        'root',     // El usuario
        '',            // La contraseña
        'pibd'
    ); // La base de datos
    
    if (!$link) {
        
        header("Location: ../php/index.php?mail=2");
        exit;
    
    } // Ejecuta una sentencia SQL
    
    $sentencia = "SELECT * FROM paises ORDER BY paises.NomPais ASC";

    if(!($resultado = @mysqli_query($link, $sentencia))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo'</p>';
        exit;
    }

    while($fila = mysqli_fetch_assoc($resultado))     {
        echo "<option>" .  $fila['NomPais'] . "</option>"; 
    }
}

//Devolver album
function devAlbum()
{
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

    $sentencia = "SELECT * FROM albumes ORDER BY albumes.Titulo ASC";

    if(!($resultado = @mysqli_query($link, $sentencia))) {
        echo '<p>Error al ejecutar la sentencia <b>$sentencia</b>: ' . mysqli_error($link);
        echo'</p>';
        exit;
    }

    while($fila = mysqli_fetch_assoc($resultado))     {
        echo "<option>" .  $fila['Titulo'] . "</option>"; 
    }
}
?>