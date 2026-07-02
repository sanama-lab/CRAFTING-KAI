<?php
class PedidoDAO {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }
    public function agregarPedido(Pedido $pedido) {
        $sql = "INSERT INTO pedidos (id_usuario, fecha_pedido, total_venta) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $id_usuario = $pedido->getIdUsuario();
        $fecha_pedido = $pedido->getFechaPedido();
        $total_venta = $pedido->getTotalVenta();
        $stmt->bind_param("isd", $id_usuario, $fecha_pedido, $total_venta);
        
        if ($stmt->execute()) {
            // Obtenemos el ID del pedido recién insertado
            return $this->db->insert_id;
        } else {
            return false;
        }
    }
    public function obtenerPedidosPorUsuario($id_usuario) {
        $sql = "SELECT id_pedido, fecha_pedido, total_venta FROM pedidos WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $pedidos = [];
        
        while ($fila = $resultado->fetch_assoc()) {
            $pedido = new Pedido($fila['id_pedido'], $id_usuario, $fila['fecha_pedido'], $fila['total_venta']);

            $pedidos[] = $pedido;
        }
        
        return $pedidos;
    }
}
?>