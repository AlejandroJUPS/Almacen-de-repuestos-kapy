<?php
include("../config/db.php");
$r=$conn->query("SELECT * FROM inventario");
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Catálogo</h2>
<?php
while($i=$r->fetch_assoc()){
	echo "<div class='card' style='margin-bottom:10px'><b>{$i['nombre']}</b><br>";
	echo "<span class='muted'>Código:</span> {$i['codigo']}<br>";
	echo "<span class='muted'>Stock:</span> {$i['stock']} &nbsp; <span class='muted'>Precio:</span> {$i['precio']}";
	echo "</div>";
}
?>
</div>