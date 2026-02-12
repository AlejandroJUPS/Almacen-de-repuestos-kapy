<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Repuestos de Motos</title>
    <link rel="stylesheet" href="/assets/css/dark.css">
    <style>
        .topbar{display:flex;justify-content:flex-end;gap:10px;margin-bottom:20px}
        .hero{padding:28px}
        .hero h1{font-size:2rem;margin-bottom:10px}
        .hero p{max-width:700px}
        .hero-actions{display:flex;gap:10px;flex-wrap:wrap;margin-top:16px}
    </style>
</head>
<body>
    <div class="container hero">
        <div class="topbar">
            <?php if (!$isLoggedIn): ?>
                <a class="card" href="auth/login.php">Login</a>
                <a class="card" href="auth/register.php">Registro</a>
            <?php else: ?>
                <span class="muted">Hola, <?= htmlspecialchars($_SESSION['user']) ?></span>
                <a class="card" href="auth/logout.php">Cerrar sesión</a>
            <?php endif; ?>
        </div>

        <h1>Bienvenido a Kapy Repuestos</h1>
        <p class="muted">
            Gestiona y solicita repuestos para motos en un solo lugar. Nuestro servicio te permite
            consultar catálogo, enviar solicitudes y llevar control de tus pedidos de forma rápida y segura.
        </p>

        <?php if ($isLoggedIn): ?>
            <div class="hero-actions">
                <a class="card" href="inventario/catalogo.php">Ver catálogo</a>
                <a class="card" href="pedidos/formulario.php">Solicitar repuesto</a>
                <a class="card" href="inventario/carrito.php">Mi carrito</a>
            </div>
        <?php else: ?>
            <p style="margin-top:14px;">
                Inicia sesión o regístrate para acceder al servicio completo.
            </p>
        <?php endif; ?>
    </div>

    <a href="admin/admin_login.php" style="position:fixed;bottom:10px;right:10px;">Admin</a>
</body>
</html>
