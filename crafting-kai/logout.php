<?php
include 'db.php';
session_start();
// Destruir la sesión y redirigir al inicio
session_destroy();
header("Location: index.php");
exit();
?>