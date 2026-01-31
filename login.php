<?php
error_reporting(E_ALL & ~E_NOTICE); // Oculta notices no críticos
ini_set('display_errors', 1);
ini_set('session.save_path', '/tmp'); // Intenta cambiar el path de sesiones
session_start();
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conexion->prepare("SELECT id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (md5($password) == $user['password']) { // Usando MD5 en lugar de password_verify
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $user['role'];
            header("Location: admin.php");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>
    <h2>Login para Administrador</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        Usuario: <input type="text" name="username" required><br><br>
        Contraseña: <input type="password" name="password" required><br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>