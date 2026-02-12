<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repuestos</title>
    <link rel="stylesheet" href="assets/css/dark.css">
</head>
<body>
    <div class="container">
        <h1>Tienda de Repuestos</h1>

        <p>
            <a href="inventario/catalogo.php">Catalogo</a> |
            <a href="pedidos/formulario.php">Pedido</a> |
            <a href="admin/admin_login.php">Admin</a>
        </p>

        <?php if (isset($_SESSION['user'])): ?>
            <p>
                <span>Hola <?= htmlspecialchars($_SESSION['user']) ?></span> |
                <a href="auth/logout.php">Salir</a>
            </p>
        <?php else: ?>
            <p>
                <a href="auth/login.php">Login</a> |
                <a href="auth/register.php">Registro</a>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>
