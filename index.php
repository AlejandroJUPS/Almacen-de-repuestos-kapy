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
</head>
<body>
    <div class="container stack">
        <div class="space-between">
            <h1>Kapy Repuestos</h1>
            <div class="nav">
                <?php if (!$isLoggedIn): ?>
                    <a class="btn-link" href="auth/login.php">Login</a>
                    <a class="btn-link" href="auth/register.php">Registro</a>
                <?php else: ?>
                    <span class="muted">Hola, <?= htmlspecialchars($_SESSION['user']) ?></span>
                    <a class="btn-link" href="inventario/catalogo.php">Catalogo</a>
                    <a class="btn-link" href="pedidos/formulario.php">Solicitar</a>
                    <a class="btn-link" href="inventario/carrito.php">Carrito</a>
                    <a class="btn-link" href="auth/logout.php">Cerrar sesion</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="card stack" style="padding:24px;">
            <h2>Bienvenido al servicio de repuestos para motos</h2>
            <p class="muted">
                Centraliza la busqueda de repuestos, el envio de solicitudes y el seguimiento de pedidos en una sola plataforma.
                El catalogo esta organizado por categorias y el panel administrativo permite gestionar pedidos en tiempo real.
            </p>
            <div class="row">
                <span class="btn-link">Catalogo por categorias</span>
                <span class="btn-link">Solicitudes en linea</span>
                <span class="btn-link">Gestion de pedidos</span>
            </div>
            <?php if (!$isLoggedIn): ?>
                <p>Inicia sesion o registrate para acceder al servicio completo.</p>
            <?php endif; ?>
        </div>
    </div>

    <a href="admin/admin_login.php" style="position:fixed;bottom:10px;right:10px;">Admin</a>
</body>
</html>
