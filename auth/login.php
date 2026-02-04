<?php
include("../config/db.php");
if($_POST){
$email=$_POST['email'];
$pass=$_POST['password'];
$r=$conn->query("SELECT * FROM usuarios WHERE email='$email'");
$u=$r->fetch_assoc();
if($u && password_verify($pass,$u['password'])){
$_SESSION['user']=$u['nombre'];
header("Location: ../index.php");
}
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Iniciar sesión</h2>
<form method='POST'>
<label class="muted">Email</label>
<input name='email' placeholder='tu@email.com'>
<label class="muted">Contraseña</label>
<input type='password' name='password' placeholder='••••••'>
<button>Entrar</button>
</form>
</div>