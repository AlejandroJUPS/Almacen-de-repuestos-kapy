<?php
session_start();
session_destroy();
header("Location: ../index.php");
?>
<!-- logout redirects, stylesheet not necessary here -->