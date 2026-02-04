<?php
include("../config/db.php");
if($_POST){
$conn->query("INSERT INTO pedidos(nombre,telefono,modelo_moto,repuesto,mensaje)
VALUES('{$_POST['nombre']}','{$_POST['telefono']}','{$_POST['modelo']}','{$_POST['repuesto']}','{$_POST['mensaje']}')");
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Solicitud de Repuestos</h2>
<form method='POST'>
<label class="muted">Nombre</label>
<input name='nombre' placeholder='Nombre'>
<label class="muted">Teléfono</label>
<input name='telefono' placeholder='Teléfono'>
<label class="muted">Modelo</label>
<input name='modelo' placeholder='Modelo moto'>
<label class="muted">Repuesto</label>
<input name='repuesto' placeholder='Repuesto'>
<label class="muted">Mensaje</label>
<textarea name='mensaje' rows='4'></textarea>
<button>Enviar</button>
</form>
</div>