<?php
include "conexion.php";

$resultado = $conexion->query("SELECT * FROM solicitudes ORDER BY fecha DESC");
?>

<h2>Solicitudes de clientes</h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Teléfono</th>
    <th>Moto</th>
    <th>Repuesto</th>
    <th>Mensaje</th>
    <th>Estado</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>
<tr>
    <td><?php echo $fila['id']; ?></td>
    <td><?php echo $fila['nombre']; ?></td>
    <td><?php echo $fila['telefono']; ?></td>
    <td><?php echo $fila['moto']; ?></td>
    <td><?php echo $fila['repuesto']; ?></td>
    <td><?php echo $fila['mensaje']; ?></td>
    <td><?php echo $fila['estado']; ?></td>
</tr>
<?php } ?>

</table>
