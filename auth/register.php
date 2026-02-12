<?php
include("../config/db.php");
if($_POST){
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
$conn->query("INSERT INTO usuarios(nombre,email,password)
VALUES('{$_POST['nombre']}','{$_POST['email']}','$pass')");
header("Location: login.php"); exit;
}
?>
<form method="POST">
<input name="nombre" placeholder="Nombre">
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button>Registrar</button>
</form>