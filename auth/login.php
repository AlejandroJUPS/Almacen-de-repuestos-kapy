<?php
include("../config/db.php");

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($email === '' || $pass === '') {
        $error = 'Debes completar email y contrasena.';
    } else {
        $stmt = $conn->prepare("SELECT nombre, password FROM usuarios WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($dbNombre, $dbPassword);
        $found = $stmt->fetch();

        if ($found && password_verify($pass, $dbPassword)) {
            $_SESSION['user'] = $dbNombre;
            header("Location: ../index.php");
            exit;
        }

        $error = 'Credenciales invalidas.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Iniciar sesion</h2>
    <?php if ($error): ?>
        <p class="muted" style="color:#e06c75;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="POST">
        <label class="muted">Email</label>
        <input name="email" type="email" placeholder="tu@email.com" required>
        <label class="muted">Contrasena</label>
        <input type="password" name="password" placeholder="******" required>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
