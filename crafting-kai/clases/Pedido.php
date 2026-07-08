<?php
class Pedido {
    private $id_pedido;
    private $id_usuario;
    private $fecha_pedido;
    private $total_venta;
    private $detalles = []; 

    public function __construct($id_pedido, $id_usuario, $fecha, $total) {
        $this->id_pedido = $id_pedido;
        $this->id_usuario = $id_usuario;
        $this->fecha_pedido = $fecha;
        $this->total_venta = $total;
    }

    //  GETTERS 
    public function getIdPedido() { return $this->id_pedido; }
    public function getIdUsuario() { return $this->id_usuario; }
    public function getFechaPedido() { return $this->fecha_pedido; }
    public function getTotalVenta() { return $this->total_venta; }
    

    //  GESTIÓN DE DETALLES 
    public function agregarDetalle(DetallePedido $detalle) {
        $this->detalles[] = $detalle;
    }

    public function getDetalles() {
        return $this->detalles;
    }
}
?>