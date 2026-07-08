<?php
require_once 'config.php';
if (!isset($_SESSION['id']) || $_SESSION['rol'] != 3) {
    header('Location: admin.php');
    exit();
}
if (!isset($_GET['id'])) {
    
    header('Location: admin.php');
    exit();
}
$id = $_GET['id'];

$userDAO = new UsuarioDAO($conn);
$userDAO->borrarUsuarioPorId($id);

header('Location: admin.php');
exit();
?>