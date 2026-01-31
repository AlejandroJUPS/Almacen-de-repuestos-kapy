<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('session.save_path', '/tmp');
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include "conexion.php";

// Procesar eliminación de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $id = $_POST['id'];
    if ($id != $_SESSION['user_id']) { // No permitir auto-eliminación
        $stmt = $conexion->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    header("Location: manage_users.php");
    exit();
}

// Procesar actualización de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $new_password = !empty($_POST['new_password']) ? password_hash($_POST['new_password'], PASSWORD_DEFAULT) : null;
    $new_role = $_POST['new_role'];

    if ($new_password) {
        $stmt = $conexion->prepare("UPDATE users SET password = ?, role = ? WHERE id = ?");
        $stmt->bind_param("ssi", $new_password, $new_role, $id);
    } else {
        $stmt = $conexion->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $new_role, $id);
    }
    $stmt->execute();
    header("Location: manage_users.php");
    exit();
}

$resultado = $conexion->query("SELECT id, username, role FROM users ORDER BY id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administrar Usuarios</title>
</head>
<body>
    <h2>Administrar Usuarios</h2>
    <p><a href="admin.php">Volver al Panel</a> | <a href="logout.php">Cerrar Sesión</a></p>

    <table border="1">
    <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>

    <?php while($fila = $resultado->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $fila['id']; ?></td>
        <td><?php echo $fila['username']; ?></td>
        <td><?php echo $fila['role']; ?></td>
        <td>
            <!-- Formulario para editar -->
            <form method="POST" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                Nueva Contraseña (opcional): <input type="password" name="new_password"><br>
                Rol: <select name="new_role">
                    <option value="user" <?php if($fila['role']=='user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if($fila['role']=='admin') echo 'selected'; ?>>Admin</option>
                </select>
                <button type="submit" name="update_user">Actualizar</button>
            </form>
            <!-- Formulario para eliminar -->
            <?php if ($fila['id'] != $_SESSION['user_id']) { ?>
            <form method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar usuario?')">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <button type="submit" name="delete_user">Eliminar</button>
            </form>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>

    </table>
</body>
</html>