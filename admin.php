<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "conexion.php";

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

// Procesar actualización de estado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $stmt = $conexion->prepare("UPDATE solicitudes SET status = ?, attended_by = ? WHERE id = ?");
    $stmt->bind_param("sii", $status, $user_id, $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Procesar agregar usuario (solo admin)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user']) && $role == 'admin') {
    $new_username = $_POST['new_username'];
    $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $stmt = $conexion->prepare("INSERT INTO users (username, password, role, created_by) VALUES (?, ?, 'user', ?)");
    $stmt->bind_param("ssi", $new_username, $new_password, $user_id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

$resultado = $conexion->query("SELECT s.*, u.username as attended_by_name FROM solicitudes s LEFT JOIN users u ON s.attended_by = u.id ORDER BY s.fecha DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
</head>
<body>
    <h2>Solicitudes de Clientes</h2>
    <p>Bienvenido, <?php echo $_SESSION['username']; ?> (<?php echo $role; ?>) | <a href="logout.php">Cerrar Sesión</a></p>
    <?php if ($role == 'admin') { ?>
    <p><a href="manage_users.php">Administrar Usuarios</a></p>
    <?php } ?>

    <table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Moto</th>
        <th>Repuesto</th>
        <th>Mensaje</th>
        <th>Estado</th>
        <th>Atendido por</th>
        <th>Acciones</th>
    </tr>

    <?php while($fila = $resultado->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $fila['id']; ?></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['telefono']; ?></td>
        <td><?php echo $fila['moto']; ?></td>
        <td><?php echo $fila['repuesto']; ?></td>
        <td><?php echo $fila['mensaje']; ?></td>
        <td><?php echo $fila['status']; ?></td>
        <td><?php echo $fila['attended_by_name'] ?: 'N/A'; ?></td>
        <td>
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <select name="status">
                    <option value="pending" <?php if($fila['status']=='pending') echo 'selected'; ?>>Pendiente</option>
                    <option value="atendiendo" <?php if($fila['status']=='atendiendo') echo 'selected'; ?>>Atendiendo</option>
                    <option value="completado" <?php if($fila['status']=='completado') echo 'selected'; ?>>Completado</option>
                </select>
                <button type="submit" name="update_status">Actualizar</button>
            </form>
        </td>
    </tr>
    <?php } ?>

    </table>

    <?php if ($role == 'admin') { ?>
    <h3>Agregar Nuevo Usuario</h3>
    <form method="POST">
        Usuario: <input type="text" name="new_username" required><br><br>
        Contraseña: <input type="password" name="new_password" required><br><br>
        <button type="submit" name="add_user">Agregar Usuario</button>
    </form>
    <?php } ?>
</body>
</html>
