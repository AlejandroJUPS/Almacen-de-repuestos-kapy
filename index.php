<?php session_start(); ?>
<!DOCTYPE html><html lang="es"><head>
<meta charset="UTF-8">
<link rel="stylesheet" href="assets/css/dark.css">
<title>Repuestos</title></head>
<body>
<div class="container">
<h1>Tienda de Repuestos</h1>
<a href="inventario/catalogo.php">Catálogo</a> |
<a href="pedidos/formulario.php">Pedido</a> |
<?php if(isset($_SESSION['user'])): ?>
<span>Hola <?= $_SESSION['user'] ?></span> <a href="auth/logout.php">Salir</a>
<?php else: ?>
<a href="auth/login.php">Login</a>
<?php endif; ?>
</div></body></html>