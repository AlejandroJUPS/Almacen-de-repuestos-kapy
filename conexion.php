<?php
// Verifica el host correcto en tu panel de infinityfree (puede ser sqlXXX.epizy.com)
$conexion = new mysqli(
    "sql109.epizy.com",   // Cambia esto al host correcto de infinityfree
    "if0_40984794",
    "ggdbC8cPafh8",
    "if0_40984794_servicio_motos",
    3306
);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
