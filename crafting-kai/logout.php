<?php
require_once 'config.php';
// Destruir la sesión y redirigir al inicio
session_destroy();
header("Location: index.php");
exit();
?>