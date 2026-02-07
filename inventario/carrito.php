<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /auth/login.php");
    exit;
}

$carrito = $_SESSION['carrito'] ?? [];
?>

<link rel="stylesheet" href="/assets/css/dark.css">

<div class="container">
    <h2>Mi Carrito</h2>

    <?php if (empty($carrito)): ?>
        <p>El carrito está vacío.</p>
    <?php else: ?>
        <?php foreach ($carrito as $item): ?>
            <div class="card" style="margin-bottom:8px;">
                <b><?= $item['nombre'] ?></b><br>
                <span class="muted">Código:</span> <?= $item['codigo'] ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" action="vaciar_carrito.php">
            <button>Vaciar carrito</button>
        </form>
    <?php endif; ?>
</div>
