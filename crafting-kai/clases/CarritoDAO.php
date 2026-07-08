<?php
// carpeta_clases/CarritoDAO.php
class CarritoDAO {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }
    
    public function crearCarrito($id_usuario) {
        $sql = "INSERT INTO carritos (Fecha_creacion, id_usuario) VALUES (NOW(), ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        if ($stmt->execute()) {
            return $this->db->insert_id; // Retorna el ID del nuevo carrito
        } else {
            return false; // Error al crear el carrito
        }
    }

    public function obtenerCarritoPorId($id_usuario) {
        $sql = "SELECT id_carrito FROM carritos WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            return $fila['id_carrito'];
        } else {
            return null; // No se encontró un carrito para este usuario
        }
    }
    public function guardarCarritoEnDB($id_carrito, $id_producto, $cantidad) {
        // 1. Primero limpiamos lo que había antes para este carrito
        $sql = "INSERT INTO detalle_carrito (id_carrito, id_producto, cantidad) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("iii", $id_carrito, $id_producto, $cantidad);
        return $stmt->execute();
        $productoDAO = new ProductoDAO($this->db);
        $productoDAO->decrementarStock($id_producto);
    }
    public function obtenerDetalleCarrito($id_carrito) {
        $sql = "SELECT id_detalle_car, id_carrito, id_producto, cantidad FROM detalle_carrito WHERE id_carrito = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_carrito);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $detalles = [];
        
        while ($fila = $resultado->fetch_assoc()) {
            $detalles[] = new DetalleCarrito(
                $fila['id_detalle_car'],
                $fila['id_carrito'],
                $fila['id_producto'],
                $fila['cantidad']
            );

        }
        $resultado->free();

        return $detalles;
    }
    public function eliminarDetalleCarrito($id_detalle_car) {
        $sql = "DELETE FROM detalle_carrito WHERE id_detalle_car = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id_detalle_car);
        return $stmt->execute();
    }
}
?>