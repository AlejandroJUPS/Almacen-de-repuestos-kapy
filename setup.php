<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include "conexion.php";

// Función para verificar si una columna existe
function columnExists($table, $column) {
    global $conexion;
    $result = $conexion->query("SHOW COLUMNS FROM $table LIKE '$column'");
    return $result->num_rows > 0;
}

// Crear tabla de usuarios si no existe
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_by INT,
    FOREIGN KEY (created_by) REFERENCES users(id)
)";

if ($conexion->query($sql_users) === TRUE) {
    echo "Tabla 'users' creada o ya existe.<br>";
} else {
    echo "Error creando tabla 'users': " . $conexion->error . "<br>";
}

// Agregar columnas a solicitudes si no existen
if (!columnExists('solicitudes', 'status')) {
    $sql_add_status = "ALTER TABLE solicitudes ADD COLUMN status VARCHAR(20) DEFAULT 'pending'";
    if ($conexion->query($sql_add_status) === TRUE) {
        echo "Columna 'status' agregada a 'solicitudes'.<br>";
    } else {
        echo "Error agregando columna 'status': " . $conexion->error . "<br>";
    }
} else {
    echo "Columna 'status' ya existe en 'solicitudes'.<br>";
}

if (!columnExists('solicitudes', 'attended_by')) {
    $sql_add_attended = "ALTER TABLE solicitudes ADD COLUMN attended_by INT";
    if ($conexion->query($sql_add_attended) === TRUE) {
        echo "Columna 'attended_by' agregada a 'solicitudes'.<br>";
    } else {
        echo "Error agregando columna 'attended_by': " . $conexion->error . "<br>";
    }
} else {
    echo "Columna 'attended_by' ya existe en 'solicitudes'.<br>";
}

// Agregar foreign key si no existe (esto es más complicado, pero intentamos)
try {
    $sql_fk = "ALTER TABLE solicitudes ADD CONSTRAINT fk_attended_by FOREIGN KEY (attended_by) REFERENCES users(id)";
    $conexion->query($sql_fk);
    echo "Foreign key agregada o ya existe.<br>";
} catch (Exception $e) {
    echo "Foreign key ya existe o error: " . $e->getMessage() . "<br>";
}

// Insertar usuario admin inicial si no existe
$result = $conexion->query("SELECT id FROM users WHERE username = 'AdminCrhist'");
if ($result->num_rows == 0) {
    $admin_password = md5('820629025'); // Usando MD5 en lugar de hash
    $sql_insert_admin = "INSERT INTO users (username, password, role) VALUES ('AdminCrhist', '$admin_password', 'admin')";

    if ($conexion->query($sql_insert_admin) === TRUE) {
        echo "Usuario admin inicial creado. Usuario: AdminCrhist, Contraseña: 820629025<br>";
    } else {
        echo "Error creando usuario admin: " . $conexion->error . "<br>";
    }
} else {
    echo "Usuario admin ya existe.<br>";
}

echo "Configuración completada. <a href='login.php'>Ir al login</a>";
?>