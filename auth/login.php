<?php
include("../config/db.php");
if($_POST){
$email=$_POST['email'];
$pass=$_POST['password'];
$r=$conn->query("SELECT * FROM usuarios WHERE email='$email'");
$u=$r->fetch_assoc();
if($u && password_verify($pass,$u['password'])){
$_SESSION['user']=$u['nombre'];
header("Location: ../index.php"); exit;
}
}
?>
<form method="POST">
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button>Entrar</button>
</form>