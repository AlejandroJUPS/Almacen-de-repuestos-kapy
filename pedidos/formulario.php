<?php
include("../config/db.php");

$error = '';
$success = false;

$nombre = '';
$telefono = '';
$modelo = '';
$repuesto = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $repuesto = trim($_POST['repuesto'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if ($nombre === '' || $telefono === '' || $modelo === '' || $repuesto === '') {
        $error = "Completa los campos obligatorios.";
    } else {
        $stmt = $conn->prepare("INSERT INTO pedidos(nombre, telefono, modelo_moto, repuesto, mensaje) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $telefono, $modelo, $repuesto, $mensaje);
        $stmt->execute();
        $stmt->close();
        $success = true;

        $nombre = $telefono = $modelo = $repuesto = $mensaje = '';
    }
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Solicitud de Repuestos</h2>
<?php if ($error): ?>
    <div class="error-message" style="margin-bottom: 12px;"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>
<?php if ($success): ?>
    <div class="success-message" style="margin-bottom: 12px;">Solicitud enviada correctamente.</div>
<?php endif; ?>
<form method='POST'>
<label class="muted">Nombre</label>
<input name='nombre' placeholder='Nombre' value="<?php echo htmlspecialchars($nombre); ?>">
<label class="muted">Teléfono</label>
<input name='telefono' placeholder='Teléfono' value="<?php echo htmlspecialchars($telefono); ?>">
<label class="muted">Modelo</label>
<input name='modelo' placeholder='Modelo moto' value="<?php echo htmlspecialchars($modelo); ?>">
<label class="muted">Repuesto</label>
<input name='repuesto' placeholder='Repuesto' value="<?php echo htmlspecialchars($repuesto); ?>">
<label class="muted">Mensaje</label>
<textarea name='mensaje' rows='4'><?php echo htmlspecialchars($mensaje); ?></textarea>
<button>Enviar</button>
</form>
</div>
