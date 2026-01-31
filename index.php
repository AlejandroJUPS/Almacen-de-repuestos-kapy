<!DOCTYPE html>
<html>
<head>
    <title>Servicio de Repuestos de Motos</title>
</head>
<body>

<h2>Solicitud de Repuestos</h2>

<form action="guardar.php" method="POST">
    Nombre:<br>
    <input type="text" name="nombre" required><br><br>

    Teléfono:<br>
    <input type="text" name="telefono" required><br><br>

    Modelo de moto:<br>
    <input type="text" name="moto" required><br><br>

    Repuesto solicitado:<br>
    <input type="text" name="repuesto" required><br><br>

    Mensaje adicional:<br>
    <textarea name="mensaje"></textarea><br><br>

    <button type="submit">Enviar solicitud</button>
</form>

</body>
</html>
