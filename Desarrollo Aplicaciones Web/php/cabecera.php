<?php
  @ob_start();
  //session_start();
  $title = "Cabecera";
  //require_once("cabecera.php");
  //require_once("iniciolog.inc");
  require_once("inicioBD.php");
  //include("functions.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- José Luis Segura Navarro y Pablo Guillén García -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?php
  if(isset($_SESSION['name'])){
    $nombre = $_SESSION['name'];

    $est = "SELECT Estilo FROM usuarios WHERE NomUsuario = '$nombre'";

    if (mysqli_query($link, $est)) {
      //echo $est;

      $resultado = @mysqli_query($link, $est);

      $fila = mysqli_fetch_assoc($resultado);

      //echo $fila['Estilo'];
      
    } else {
      echo "ERROR: No se ejecuto $est. " . mysqli_error($link);
    }

  }

  //echo $res;

  if(isset($_SESSION['acceso'])){
    //if ((isset($_SESSION['name']) && $_SESSION['name'] == 'Juan') || (isset($_COOKIE['usuario']) && $_COOKIE['usuario'] == 'Juan')) {
    if(isset($_SESSION['name']) && $fila['Estilo']==1){
    ?>
      <link href="../CSS/minimum.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
      <link href="../CSS/medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 1024px)" />
      <link href="../CSS/maximum.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1025px)" />
      <link rel="stylesheet" type="text/css" href="../CSS/dark.css" title="Modo noche" />
    <?php
    } //else if (isset($_SESSION['name']) && $_SESSION['name'] == 'Pepe' || (isset($_COOKIE['usuario']) && $_COOKIE['usuario'] == 'Pepe')) {
      else if(isset($_SESSION['name']) && $fila['Estilo'] == 2){
    ?>
      <link href="../CSS/minimum.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
      <link href="../CSS/medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 1024px)" />
      <link href="../CSS/maximum.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1025px)" />
      <link rel="stylesheet" type="text/css" href="../CSS/altoContraste.css" />
    <?php

    } //else if (isset($_SESSION['name']) && $_SESSION['name'] == 'Antonio' || (isset($_COOKIE['usuario']) && $_COOKIE['usuario'] == 'Antonio')) {
      else if (isset($_SESSION['name']) && $fila['Estilo'] == 3) {
    ?>
      <link href="../CSS/minimum.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
      <link href="../CSS/medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 1024px)" />
      <link href="../CSS/maximum.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1025px)" />
      <link rel="stylesheet" type="text/css" href="../CSS/accesible.css"/>
    <?php

    } //else if (isset($_SESSION['name']) && $_SESSION['name'] == 'Sonia' || (isset($_COOKIE['usuario']) && $_COOKIE['usuario'] == 'Sonia')) {
      else if (isset($_SESSION['name']) && $fila['Estilo'] == 4) {
    ?>
      <link href="../CSS/minimum.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
      <link href="../CSS/medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 1024px)" />
      <link href="../CSS/maximum.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1025px)" />
      <link rel="stylesheet" type="text/css" href="../CSS/letraGrande.css" title="Modo noche" />
    <?php
    }
  }else{
    ?>
    <link href="../CSS/minimum.css" rel="stylesheet" type="text/css" media="screen and (max-width: 480px)" />
    <link href="../CSS/medium.css" rel="stylesheet" type="text/css" media="screen and (min-width: 481px) and (max-width: 1024px)" />
    <link href="../CSS/maximum.css" rel="stylesheet" type="text/css" media="screen and (min-width: 1025px)" />
  <?php
  }
  ?>
  
  <link rel="stylesheet" type="text/css" href="../CSS/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="../CSS/menu2.css" />
  <link rel="stylesheet" href="fontello-b5197392/css/fontello-embedded.css">

  <title>Picturefy</title>
</head>