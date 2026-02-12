<?php
session_start();
$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? htmlspecialchars($_SESSION['user']) : null;
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapy Repuestos | Inicio</title>
    <link rel="stylesheet" href="assets/css/dark.css">
</head>
<body>

<div class="container stack">

    <!-- HEADER -->
    <header class="space-between">
        <h1>Kapy Repuestos</h1>
        <nav class="nav">

            <a class="btn-link" href="inventario/catalogo.php">Catálogo</a>

            <?php if (!$isLoggedIn): ?>
                <a class="btn-link" href="auth/login.php">Login</a>
                <a class="btn-link" href="auth/register.php">Registro</a>
            <?php else: ?>
                <span class="muted">Hola, <?= $username ?></span>
                <a class="btn-link" href="pedidos/formulario.php">Solicitar</a>
                <a class="btn-link" href="auth/logout.php">Cerrar sesión</a>
            <?php endif; ?>

        </nav>
    </header>

    <!-- HERO -->
    <section class="card stack" style="padding: 32px;">
        <h2>Repuestos para motos en un solo lugar</h2>
        <p class="muted">
            Explora nuestro catálogo de repuestos y realiza solicitudes de forma
            rápida y sencilla desde una plataforma clara y moderna.
        </p>

        <div class="row">
            <a class="btn-link" href="inventario/catalogo.php">
                Ver catálogo
            </a>
        </div>
    </section>

    <!-- FUNCIONES -->
    <section class="stack">
        <h3>Funciones principales</h3>

        <div class="row">

            <div class="card stack" style="padding:20px; flex:1;">
                <h4>Catálogo de repuestos</h4>
                <p class="muted">
                    Consulta los productos disponibles y agrégalos al carrito
                    directamente desde el catálogo.
                </p>
                <a class="btn-link" href="inventario/catalogo.php">
                    Explorar catálogo
                </a>
            </div>

            <div class="card stack" style="padding:20px; flex:1;">
                <h4>Solicitud de pedidos</h4>
                <p class="muted">
                    Envía tu pedido después de seleccionar los productos
                    desde el catálogo.
                </p>
                <a class="btn-link" href="pedidos/formulario.php">
                    Hacer pedido
                </a>
            </div>

        </div>
    </section>

</div>

<!-- ACCESO ADMIN -->
<a href="admin/admin_login.php"
   style="position:fixed; bottom:15px; right:15px; opacity:0.5;">
   Admin
</a>

</body>
</html>
