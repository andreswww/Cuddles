<?php
// config.php
$server = "localhost";
$user = "root"; // Tu usuario de base de datos
$pass = ""; // Tu contraseña de base de datos
$database_name = "Cuddles_BD"; // Nombre de tu base de datos

// Crear conexión
$con = new mysqli($server, $user, $pass, $database_name);

// Verificar conexión
if ($con->connect_errno) {
    die("Conexion Fallida: " . $con->connect_error);
}
?>
