<?php
include("../config/db.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nombre === '' || $email === '' || $password === '') {
        $error = 'Todos los campos son obligatorios.';
    } else {
        $passHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios(nombre, email, password) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $email, $passHash);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        }

        $error = 'No se pudo registrar. Verifica si el email ya existe.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Registro</h2>
    <?php if ($error): ?>
        <p class="muted" style="color:#e06c75;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label class="muted">Nombre</label>
        <input name="nombre" placeholder="Nombre" required>
        <label class="muted">Email</label>
        <input name="email" type="email" placeholder="Email" required>
        <label class="muted">Contrasena</label>
        <input type="password" name="password" placeholder="Contrasena" required>
        <button type="submit">Registrar</button>
    </form>
</div>
</body>
</html>
