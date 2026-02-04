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
<form method='POST'>
<input name='email'>
<input type='password' name='password'>
<button>Entrar</button>
</form>