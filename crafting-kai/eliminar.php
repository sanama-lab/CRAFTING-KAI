<?php
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $carritoDAO = new CarritoDAO($conn);
    $carritoDAO->eliminarDetalleCarrito($id);
}

header('Location: carrito.php');
exit();
?>