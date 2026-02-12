<?php
session_start();
if(!isset($_SESSION['admin'])) die("No autorizado");
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Panel Admin</h2>
<a href='pedidos.php'>Ver pedidos</a>
</div>
