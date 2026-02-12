<?php
session_start();
if($_POST && $_POST['password']=="admin123"){
$_SESSION['admin']=true;
header("Location: dashboard.php");
}
?>
<link rel="stylesheet" href="/assets/css/dark.css">
<div class="container">
<h2>Admin</h2>
<form method='POST'>
<input type='password' name='password' placeholder='Admin password'>
<button>Acceder</button>
</form>
</div>