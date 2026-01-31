<?php
$username = 'AdminCrhist';
$password = '820629025';
$hash = md5($password); // Usando MD5

echo "SQL para insertar el usuario admin:<br>";
echo "INSERT INTO users (username, password, role) VALUES ('$username', '$hash', 'admin');<br><br>";
echo "O para actualizar si ya existe:<br>";
echo "UPDATE users SET username = '$username', password = '$hash' WHERE username = 'admin';<br>";
?>