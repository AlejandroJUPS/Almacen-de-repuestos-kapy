<?php
session_start();
if (!isset($_SESSION['admin'])) {
    die("No autorizado");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Panel Admin</h2>
    <p><a href="pedidos.php">Ver pedidos</a></p>
</div>
</body>
</html>
