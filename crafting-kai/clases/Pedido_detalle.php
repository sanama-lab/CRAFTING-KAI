<?php
class DetallePedido {
    private $id_detalle_ped;
    private $id_pedido;
    private $id_producto;
    private $cantidad;
    private $precio_unitario_snapshot;

    public function __construct($id_detalle_ped, $id_pedido, $id_producto, $cantidad, $precio_snapshot) {
        $this->id_detalle_ped = $id_detalle_ped;
        $this->id_pedido = $id_pedido;
        $this->id_producto = $id_producto;
        $this->cantidad = $cantidad;
        $this->precio_unitario_snapshot = $precio_snapshot;
    }

    // Getters
    public function getIdDetalle() { return $this->id_detalle_ped; }
    public function getIdPedido() { return $this->id_pedido; }
    public function getIdProducto() { return $this->id_producto; }
    public function getCantidad() { return $this->cantidad; }
    public function getPrecioSnapshot() { return $this->precio_unitario_snapshot; }
}
?>