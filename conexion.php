<?php
$conexion = new mysqli(
    "sq109.infinityfree.com",   // Host
    "if0_40984794",              // Usuario
    "ggdbC8cPafh8",              // Contraseña
    "if0_40984794_servicio_motos", // Base de datos
    3306                         // Puerto
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
