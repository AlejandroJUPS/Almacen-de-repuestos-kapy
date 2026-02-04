<?php
session_start();
if(!isset($_SESSION['admin'])) die("No autorizado");
?>
<h2>Panel Admin</h2>
<a href='pedidos.php'>Ver pedidos</a>
