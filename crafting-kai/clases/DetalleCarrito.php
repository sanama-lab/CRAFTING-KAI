<?php
class DetalleCarrito {
    private $id_detalle_car;
    private $id_carrito;
    private $id_producto;
    private $cantidad;

    public function __construct($id_detalle_car, $id_carrito, $id_producto, $cantidad) {
        $this->id_detalle_car = $id_detalle_car;
        $this->id_carrito = $id_carrito;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
    }
    
    // Getters necesarios para que el DAO lea los datos
    public function getIdDetalle() { return $this->id_detalle_car; }
    public function getIdProducto() { return $this->id_producto; }
    public function getCantidad() { return $this->cantidad; }
}

?>