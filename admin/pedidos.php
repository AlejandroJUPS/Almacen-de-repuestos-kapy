<?php
include("../config/db.php");
if(!isset($_SESSION['admin'])) die("No autorizado");
$r=$conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Pedidos</h2>
<?php
while($p=$r->fetch_assoc()){
	echo "<div class='card' style='margin-bottom:10px'><b>{$p['nombre']}</b> <span class='muted'>{$p['telefono']}</span><br>";
	echo "<span class='muted'>Moto:</span> {$p['modelo_moto']}<br>";
	echo "<span class='muted'>Repuesto:</span> {$p['repuesto']}<br>";
	echo "<div class='muted'>{$p['mensaje']}</div>";
	echo "</div>";
}
?>
</div>