<?php
require_once 'config.php';
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}
$id_producto = $_GET['id'];
$id_carrito = $_SESSION['carrito'];
$cantidad = 1; // Por defecto, agregamos 1 unidad del producto

$carritoDAO = new CarritoDAO($conn);
$carritoDAO->guardarCarritoEnDB($id_carrito, $id_producto, $cantidad);

header('Location: index.php');
exit();
?>