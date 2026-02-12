<?php
session_start();
if(!isset($_SESSION['admin'])) die("No autorizado");
?>
<a href="pedidos.php">Ver pedidos</a>