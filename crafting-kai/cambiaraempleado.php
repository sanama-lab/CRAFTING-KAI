<?php
require_once 'config.php';
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 3) {
    header('Location: admin.php');
    exit();
}
if (!isset($_GET['id'])) {
    // Si no se proporciona un ID, redirigir a la página de administración
    header('Location: admin.php');
    exit();
}
$id = $_GET['id'];

$userDAO = new UsuarioDAO($conn);
$userDAO->cambiarRolUsuario($id, 2);

header('Location: admin.php');
exit();
?>