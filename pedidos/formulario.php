<?php
include("../config/db.php");
if($_POST){
$conn->query("INSERT INTO pedidos(nombre,telefono,modelo_moto,repuesto,mensaje)
VALUES('{$_POST['nombre']}','{$_POST['telefono']}','{$_POST['modelo']}','{$_POST['repuesto']}','{$_POST['mensaje']}')");
}
?>
<form method="POST">
<input name="nombre" placeholder="Nombre">
<input name="telefono" placeholder="Teléfono">
<input name="modelo" placeholder="Modelo moto">
<input name="repuesto" placeholder="Repuesto">
<textarea name="mensaje"></textarea>
<button>Enviar</button>
</form>