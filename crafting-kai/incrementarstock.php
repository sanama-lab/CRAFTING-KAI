<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];
    $productoDAO = new ProductoDAO($conn);
    $productoDAO->incrementarStock($id_producto);
    header('Location: index.php');
    exit();
}

?>