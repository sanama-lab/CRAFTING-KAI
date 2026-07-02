<?php
class Carrito {
    private $items = []; // Aquí guardaremos los objetos Producto

    // Método para agregar un producto al carrito
    public function agregarProducto(Producto $producto) {
        $this->items[] = $producto;
    }

    // Método para obtener todos los productos
    public function getProductos() {
        return $this->items;
    }

    // Método para calcular el total de la compra
    public function calcularTotal() {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getprecio();
        }
        return $total;
    }

    // Método para contar cuántos productos hay
    public function cantidadProductos() {
        return count($this->items);
    }
}
?>

 