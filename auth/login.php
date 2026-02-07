<?php
include("../config/db.php");

$error = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';

    if ($email === '' || $pass === '') {
        $error = "Completa email y contraseña.";
    } else {
        $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $u = $result ? $result->fetch_assoc() : null;
        $stmt->close();

        if ($u && password_verify($pass, $u['password'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = $u['nombre'];
            header("Location: ../index.php");
            exit();
        }

        $error = "Credenciales inválidas.";
    }
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Iniciar sesión</h2>
<?php if ($error): ?>
    <div class="error-message" style="margin-bottom: 12px;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method='POST'>
<label class="muted">Email</label>
<input name='email' placeholder='tu@email.com' value="<?php echo htmlspecialchars($email); ?>">
<label class="muted">Contraseña</label>
<input type='password' name='password' placeholder='••••••' autocomplete="current-password">
<button>Entrar</button>
</form>
</div>
