<?php
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}
$carritoDAO = new CarritoDAO($conn);
$detalles = $carritoDAO->obtenerDetalleCarrito($_SESSION['carrito']);
$productoDAO = new ProductoDAO($conn);
$total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito - Crafting-Kai</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container header-container">
            <div class="site-title">
                <a href="index.php"><h1>Crafting-<span>Kai</span> Mercado online</h1></a>
            </div>
            <nav class="header-actions">
                <a href="index.php" class="btn-action">Seguir Comprando</a>
            </nav>
        </div>
    </header>

    <main class="container cart-section">
        <h2 class="section-title">Tu Carrito de Impresiones</h2>
        
        <div class="cart-layout">
            <div class="cart-items">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="carrito-body">
                        <?php 
                        if (empty($detalles)) {?>
                            <tr><td colspan='3'>El carrito está vacío</td></tr>
                        
                        <?php  } else {
                            
                        foreach ($detalles as $detalle) {  
                            $producto = $productoDAO->obtenerPorId($detalle->getIdProducto());
                            // 2. Extraemos los datos del producto de forma segura
                            $nombreProducto = htmlspecialchars($producto->getNombre());
                            $precioUnitario = $producto->getPrecio(); // El precio viene del catálogo
        
                            // 3. Tomamos la cantidad real de la tabla detalle_carrito
                            $cantidad = $detalle->getCantidad();
        
                            // 4. Calculamos el subtotal de esta fila
                            $total = $total + $precioUnitario;
                            ?>
                            <tr>
                                <td><?php echo $nombreProducto; ?> <?php echo $detalle->getIdProducto(); ?></td>
                                <td><?php echo $precioUnitario; ?></td>
                                <td><?php echo $cantidad; ?></td> 
                                <td><?php echo $total; ?></td>
                                <td><button class="btn-remove" ><a href="eliminar.php?id=<?php echo $detalle->getIdDetalle(); ?>"><i class="fas fa-trash"></i></a></button></td>
                            </tr>
                        <?php } } ?>
                    </tbody>
                
                </table>
            </div>

            <aside class="cart-summary">
                <h3>Resumen de Compra</h3>
            
                <div class="summary-detail">
                    <span>Subtotal:</span>
                    <span id="subtotal">$<?php echo $total; ?></span>
                </div>
            
                <div class="summary-detail">
                    <span>Envío:</span>
                    <span class="free">Gratis</span>
                </div>
            
                <hr>
            
                <div class="summary-total">
                    <span>Total:</span>
                    <span id="total">$<?php echo $total; ?></span>
                </div>
            
                <button class="btn-checkout">
                    Proceder al Pago
                </button>
            </aside>
            
        </div>
    </main>
</body>
</html>