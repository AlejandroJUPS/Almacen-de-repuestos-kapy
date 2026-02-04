<?php
include("../config/db.php");
if(!isset($_SESSION['admin'])) die("No autorizado");
$r=$conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
while($p=$r->fetch_assoc()){
echo "<p><b>{$p['nombre']}</b> {$p['telefono']}<br>
Moto: {$p['modelo_moto']}<br>
Repuesto: {$p['repuesto']}<br>
{$p['mensaje']}</p><hr>";
}
?>