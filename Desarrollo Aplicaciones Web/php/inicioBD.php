
<?php
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
?>