<?php
session_start();
include("../config/db.php");
if(!isset($_SESSION['admin'])) die("No autorizado");
$r=$conn->query("SELECT * FROM pedidos");
while($p=$r->fetch_assoc()){
echo "<p>{$p['nombre']} - {$p['repuesto']}</p>";
}
?>