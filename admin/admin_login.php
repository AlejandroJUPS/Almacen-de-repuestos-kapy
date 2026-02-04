<?php
session_start();
if($_POST && $_POST['password']=="admin123"){
$_SESSION['admin']=true;
header("Location: dashboard.php");
}
?>
<form method='POST'>
<input type='password' name='password' placeholder='Admin password'>
<button>Acceder</button>
</form>