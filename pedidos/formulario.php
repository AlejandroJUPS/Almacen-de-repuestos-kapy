<?php
include("../config/db.php");

$ok = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $modelo = trim($_POST['modelo'] ?? '');
    $repuesto = trim($_POST['repuesto'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if ($nombre === '' || $telefono === '' || $modelo === '' || $repuesto === '') {
        $error = 'Completa los campos obligatorios.';
    } else {
        $stmt = $conn->prepare("INSERT INTO pedidos(nombre, telefono, modelo_moto, repuesto, mensaje) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $telefono, $modelo, $repuesto, $mensaje);
        $ok = $stmt->execute();
        if (!$ok) {
            $error = 'No se pudo guardar el pedido.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Repuestos</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Solicitud de Repuestos</h2>
    <?php if ($ok): ?>
        <p class="muted" style="color:#4aa3a3;">Solicitud enviada correctamente.</p>
    <?php elseif ($error): ?>
        <p class="muted" style="color:#e06c75;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label class="muted">Nombre</label>
        <input name="nombre" placeholder="Nombre" required>
        <label class="muted">Telefono</label>
        <input name="telefono" placeholder="Telefono" required>
        <label class="muted">Modelo</label>
        <input name="modelo" placeholder="Modelo moto" required>
        <label class="muted">Repuesto</label>
        <input name="repuesto" placeholder="Repuesto" required>
        <label class="muted">Mensaje</label>
        <textarea name="mensaje" rows="4"></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>
</body>
</html>
