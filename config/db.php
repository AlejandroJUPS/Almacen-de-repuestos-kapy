<?php
session_start();
$conn = new mysqli("localhost","root","","repuestos");
if($conn->connect_error){ die("DB Error"); }
?>