<?php
include("../config/db.php");
if (!isset($_SESSION['admin'])) {
    die("No autorizado");
}

$result = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
if (!$result) {
    $result = $conn->query("SELECT * FROM pedidos ORDER BY id DESC");
}
if (!$result) {
    $result = $conn->query("SELECT * FROM pedidos");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Pedidos</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($p = $result->fetch_assoc()): ?>
            <div class="card" style="margin-bottom:10px;">
                <b><?= htmlspecialchars($p['nombre']) ?></b>
                <span class="muted"><?= htmlspecialchars($p['telefono']) ?></span><br>
                <span class="muted">Moto:</span> <?= htmlspecialchars($p['modelo_moto']) ?><br>
                <span class="muted">Repuesto:</span> <?= htmlspecialchars($p['repuesto']) ?><br>
                <div class="muted"><?= nl2br(htmlspecialchars($p['mensaje'])) ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="muted">No hay pedidos registrados.</p>
    <?php endif; ?>
</div>
</body>
</html>
