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
$q=''; $modelo='';
if(isset($_GET['q'])) $q=trim($_GET['q']);
if(isset($_GET['modelo'])) $modelo=trim($_GET['modelo']);

?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<div class="catalog-controls">
	<form class="search-input" method="GET" action="catalogo.php">
		<input name="q" placeholder="Buscar repuesto por nombre" value="<?= htmlspecialchars($q) ?>">
		<input name="modelo" placeholder="Modelo de moto (opcional)" value="<?= htmlspecialchars($modelo) ?>">
		<button type="submit">Buscar</button>
	</form>
</div>
<?php
include("../config/db.php");
$whereParts = [];
if($q !== ''){
	$safe = $conn->real_escape_string($q);
	$whereParts[] = "nombre LIKE '%$safe%'";
}
if($modelo !== ''){
	$safeM = $conn->real_escape_string($modelo);
	// try matching model text inside `nombre` as fallback if there is no dedicated model column
	$whereParts[] = "nombre LIKE '%$safeM%'";
}
$where = '';
if(count($whereParts)) $where = 'WHERE '.implode(' AND ',$whereParts);
$sql = "SELECT * FROM inventario $where LIMIT 200";
$r = $conn->query($sql);
?>
<div class="grid">
<?php
while($i=$r->fetch_assoc()){
	$nombre = htmlspecialchars($i['nombre']);
	$codigo = htmlspecialchars($i['codigo'] ?? '');
	$stock = htmlspecialchars($i['stock'] ?? '0');
	$precio = isset($i['precio']) ? number_format($i['precio'],2) : '0.00';
	$img = isset($i['imagen']) && $i['imagen'] ? $i['imagen'] : 'https://via.placeholder.com/240x160?text=Imagen';
	echo "<div class='product-card'>";
	echo "<div class='product-media'><img src='$img' alt='Imagen'></div>";
	echo "<div class='product-body'>";
	echo "<div class='product-title'>$nombre</div>";
	echo "<div class='product-meta'>Código: $codigo &nbsp; | &nbsp; Stock: $stock</div>";
	echo "<div class='product-price'>S/ $precio</div>";
	echo "<div class='product-actions'><a class='btn' href='../pedidos/formulario.php?repuesto=".urlencode($nombre)."&modelo=".urlencode($modelo)."'>Solicitar</a></div>";
	echo "</div>";
	echo "</div>";
}
?>
</div>
</div>