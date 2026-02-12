<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$carrito = $_SESSION['carrito'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
<div class="container">
    <h2>Mi Carrito</h2>

    <?php if (empty($carrito)): ?>
        <p>El carrito esta vacio.</p>
    <?php else: ?>
        <?php foreach ($carrito as $item): ?>
            <div class="card" style="margin-bottom:8px;">
                <b><?= htmlspecialchars($item['nombre']) ?></b><br>
                <span class="muted">Codigo:</span> <?= htmlspecialchars($item['codigo']) ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" action="vaciar_carrito.php">
            <button type="submit">Vaciar carrito</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
