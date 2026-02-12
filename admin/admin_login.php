<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    if ($password === "admin123") {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    }
    $error = 'Contrasena de admin incorrecta.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Admin</h2>
    <?php if ($error): ?>
        <p class="muted" style="color:#e06c75;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <input type="password" name="password" placeholder="Admin password" required>
        <button type="submit">Acceder</button>
    </form>
</div>
</body>
</html>
