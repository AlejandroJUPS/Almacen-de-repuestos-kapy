<?php
include("../config/db.php");
if($_POST){
$conn->query("INSERT INTO pedidos(nombre,telefono,modelo_moto,repuesto,mensaje)
VALUES('{$_POST['nombre']}','{$_POST['telefono']}','{$_POST['modelo']}','{$_POST['repuesto']}','{$_POST['mensaje']}')");
}
?>
<h2>Solicitud de Repuestos</h2>
<form method='POST'>
<input name='nombre' placeholder='Nombre'><br>
<input name='telefono' placeholder='Teléfono'><br>
<input name='modelo' placeholder='Modelo moto'><br>
<input name='repuesto' placeholder='Repuesto'><br>
<textarea name='mensaje'></textarea><br>
<button>Enviar</button>
</form>