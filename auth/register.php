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
<form method='POST'>
<input name='nombre' placeholder='Nombre'>
<input name='email' placeholder='Email'>
<input type='password' name='password' placeholder='Contraseña'>
<button>Registrar</button>
</form>