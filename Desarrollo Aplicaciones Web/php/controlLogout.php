<?php

session_start();

if (isset($_SESSION['user']) || isset($_COOKIE['usuario'])) {
    $_SESSION = array();

    setcookie('usuario', '', time() - 42000, '/');
    setcookie('contrasena', '', time() - 42000, '/');
    setcookie('fechahora', '', time() - 42000, '/');

    session_destroy();

    header('Location: ../php/index.php');
    exit;
}else{
    // $_SESSION['acceso'] = false;
    // $_SESSION['name'] = '';

    session_destroy();

    header('Location: ../php/index.php');
    exit;
}

?>