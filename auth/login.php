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
        $fixedEmail = "ss@gmail.com";
        $fixedPass = "3210";

        if (hash_equals($fixedEmail, $email) && hash_equals($fixedPass, $pass)) {
            session_regenerate_id(true);
            $_SESSION['user'] = $fixedEmail;
            $_SESSION['admin'] = true;
            header("Location: ../admin/dashboard.php");
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
