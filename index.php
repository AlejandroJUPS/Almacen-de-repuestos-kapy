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

            <?php if (!$isLoggedIn): ?>
                <a class="btn-link" href="auth/login.php">Login</a>
                <a class="btn-link" href="auth/register.php">Registro</a>
            <?php else: ?>
                <span class="muted">Hola, <?= $username ?></span>
                <a class="btn-link" href="inventario/catalogo.php">Catálogo</a>
                <a class="btn-link" href="inventario/carrito.php">Carrito</a>
                <a class="btn-link" href="pedidos/formulario.php">Solicitar</a>
                <a class="btn-link" href="auth/logout.php">Cerrar sesión</a>
            <?php endif; ?>

        </nav>
    </header>

    <!-- HERO / BIENVENIDA -->
    <section class="card stack" style="padding: 32px;">
        <h2>Tu plataforma integral de repuestos para motos</h2>
        <p class="muted">
            Gestiona tu búsqueda de repuestos, realiza solicitudes y lleva el seguimiento
            de tus pedidos en un solo lugar con una interfaz clara y moderna.
        </p>

        <?php if (!$isLoggedIn): ?>
            <div class="row">
                <a class="btn-link" href="auth/register.php">Crear cuenta</a>
                <a class="btn-link" href="auth/login.php">Iniciar sesión</a>
            </div>
        <?php else: ?>
            <div class="row">
                <a class="btn-link" href="inventario/catalogo.php">Explorar catálogo</a>
                <a class="btn-link" href="inventario/carrito.php">Ver carrito</a>
                <a class="btn-link" href="pedidos/formulario.php">Realizar pedido</a>
            </div>
        <?php endif; ?>
    </section>

    <!-- FUNCIONALIDADES -->
    <section class="stack">
        <h3>Funciones principales</h3>

        <div class="row">

            <div class="card stack" style="padding:20px; flex:1;">
                <h4>Catálogo</h4>
                <p class="muted">
                    Visualiza los repuestos disponibles organizados por categorías.
                </p>
                <a class="btn-link" href="inventario/catalogo.php">Ir al catálogo</a>
            </div>

            <div class="card stack" style="padding:20px; flex:1;">
                <h4>Carrito</h4>
                <p class="muted">
                    Administra los productos seleccionados antes de confirmar tu pedido.
                </p>
                <a class="btn-link" href="inventario/carrito.php">Ver carrito</a>
            </div>

            <div class="card stack" style="padding:20px; flex:1;">
                <h4>Pedidos</h4>
                <p class="muted">
                    Envía solicitudes de repuestos de manera rápida y organizada.
                </p>
                <a class="btn-link" href="pedidos/formulario.php">Solicitar ahora</a>
            </div>

        </div>
    </section>

</div>

<!-- ACCESO ADMIN DISCRETO -->
<a href="admin/admin_login.php" 
   style="position:fixed; bottom:15px; right:15px; opacity:0.5;">
   Admin
</a>

</body>
</html>
