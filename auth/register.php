<?php
include("../config/db.php");
if($_POST){
$nombre=$_POST['nombre'];
$email=$_POST['email'];
$pass=password_hash($_POST['password'],PASSWORD_DEFAULT);
$conn->query("INSERT INTO usuarios(nombre,email,password) VALUES('$nombre','$email','$pass')");
header("Location: login.php");
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Registro</h2>
<form method='POST'>
<label class="muted">Nombre</label>
<input name='nombre' placeholder='Nombre'>
<label class="muted">Email</label>
<input name='email' placeholder='Email'>
<label class="muted">Contraseña</label>
<input type='password' name='password' placeholder='Contraseña'>
<button>Registrar</button>
</form>
</div>