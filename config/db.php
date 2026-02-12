<?php
$conn = new mysqli(
    "sql109.infinityfree.com",
    "if0_40984794",
    "ggdbC8cPafh8",
    "if0_40984794_repuestos_motos",
    3306
);
if ($conn->connect_error) {
    die("Error de conexión");
}
session_start();
?>