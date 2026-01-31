<?php
include "conexion.php";

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$moto = $_POST['moto'];
$repuesto = $_POST['repuesto'];
$mensaje = $_POST['mensaje'];

$sql = "INSERT INTO solicitudes (nombre, telefono, moto, repuesto, mensaje, status)
        VALUES ('$nombre','$telefono','$moto','$repuesto','$mensaje', 'pending')";

$conexion->query($sql);

echo "Solicitud enviada correctamente.<br>";
echo "<a href='index.php'>Volver</a>";
?>
