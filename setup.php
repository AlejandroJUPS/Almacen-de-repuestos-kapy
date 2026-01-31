<?php
include "conexion.php";

// Crear tabla de usuarios
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(id)
)";

if ($conexion->query($sql_users) === TRUE) {
    echo "Tabla 'users' creada correctamente.<br>";
} else {
    echo "Error creando tabla 'users': " . $conexion->error . "<br>";
}

// Modificar tabla solicitudes
$sql_alter_solicitudes = "ALTER TABLE solicitudes 
    ADD COLUMN IF NOT EXISTS status VARCHAR(20) DEFAULT 'pending',
    ADD COLUMN IF NOT EXISTS attended_by INT,
    ADD FOREIGN KEY IF NOT EXISTS (attended_by) REFERENCES users(id)";

if ($conexion->query($sql_alter_solicitudes) === TRUE) {
    echo "Tabla 'solicitudes' modificada correctamente.<br>";
} else {
    echo "Error modificando tabla 'solicitudes': " . $conexion->error . "<br>";
}

// Insertar usuario admin inicial (cambiar contraseña después)
$admin_password = password_hash('admin123', PASSWORD_DEFAULT);
$sql_insert_admin = "INSERT IGNORE INTO users (username, password, role) VALUES ('admin', '$admin_password', 'admin')";

if ($conexion->query($sql_insert_admin) === TRUE) {
    echo "Usuario admin inicial creado. Usuario: admin, Contraseña: admin123<br>";
} else {
    echo "Error creando usuario admin: " . $conexion->error . "<br>";
}

echo "Configuración completada. <a href='login.php'>Ir al login</a>";
?>