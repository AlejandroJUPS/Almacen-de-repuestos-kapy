<?php
include("../config/db.php");

$error = '';
$nombre = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($nombre === '' || $email === '' || $password === '') {
        $error = "Completa todos los campos.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email inválido.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $exists = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($exists) {
            $error = "Ese email ya está registrado.";
        } else {
            $passHash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO usuarios(nombre, email, password) VALUES(?, ?, ?)");
            $stmt->bind_param("sss", $nombre, $email, $passHash);
            $stmt->execute();
            $stmt->close();

            header("Location: login.php");
            exit();
        }
    }
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Registro</h2>
<?php if ($error): ?>
    <div class="error-message" style="margin-bottom: 12px;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<form method='POST'>
<label class="muted">Nombre</label>
<input name='nombre' placeholder='Nombre' value="<?php echo htmlspecialchars($nombre); ?>">
<label class="muted">Email</label>
<input name='email' placeholder='Email' value="<?php echo htmlspecialchars($email); ?>">
<label class="muted">Contraseña</label>
<input type='password' name='password' placeholder='Contraseña' autocomplete="new-password">
<button>Registrar</button>
</form>
</div>
