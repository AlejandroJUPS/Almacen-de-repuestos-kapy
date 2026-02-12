<?php
$dbHost = getenv('DB_HOST') ?: "sql109.infinityfree.com";
$dbUser = getenv('DB_USER') ?: "if0_40984794";
$dbPass = getenv('DB_PASS') ?: "ggdbC8cPafh8";
$dbName = getenv('DB_NAME') ?: "if0_40984794_repuestos_motos";
$dbPort = getenv('DB_PORT') ? (int)getenv('DB_PORT') : 3306;

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
if ($conn->connect_error) {
    error_log("DB connection error: " . $conn->connect_error);
    die("Error de conexión");
}

if (!$conn->set_charset("utf8mb4")) {
    error_log("DB charset error: " . $conn->error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
