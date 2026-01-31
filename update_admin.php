<?php
include "conexion.php";

$new_username = 'AdminCrhist';
$new_password = md5('820629025'); // Usando MD5

// Actualizar el usuario admin existente
$sql = "UPDATE users SET username = ?, password = ? WHERE username = 'admin'";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("ss", $new_username, $new_password);

if ($stmt->execute()) {
    echo "Credenciales de admin actualizadas. Nuevo usuario: $new_username<br>";
    echo "<a href='login.php'>Ir al login</a>";
} else {
    echo "Error actualizando: " . $conexion->error;
}
?>