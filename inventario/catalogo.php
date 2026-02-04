<?php
include("../config/db.php");
$r=$conn->query("SELECT * FROM inventario");
while($i=$r->fetch_assoc()){
echo "<div><b>{$i['nombre']}</b><br>
Código: {$i['codigo']}<br>
Stock: {$i['stock']}<br>
Precio: {$i['precio']}<hr></div>";
}
?>