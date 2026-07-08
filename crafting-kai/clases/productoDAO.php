<?php
class ProductoDAO {
    private $conexion;

    // Ahora el constructor recibe una instancia de mysqli
    public function __construct( $conexion) {
        $this->conexion = $conexion;
    }

     // Obtiene todos los productos
    public function obtenerTodos() {
        $sql = "SELECT id_producto, nombre, descripcion, precio_actual, stock_disponible FROM productos";
        $resultado = $this->conexion->query($sql);
        
        $productos = [];
        
        if ($resultado) {
            while ($row = $resultado->fetch_assoc()) {
                // Mapeamos los nombres de las columnas SQL a las propiedades de tu clase
                $productos[] = new Producto(
                    $row['id_producto'],
                    $row['nombre'],
                    $row['precio_actual'],
                    $row['stock_disponible'],
                    $row['descripcion']
                );
            }
            // Liberamos el resultado de la memoria
            $resultado->free();
        }
        
        return $productos;
    }

    public function obtenerPorId($id) {
        $sql = "SELECT id_producto, nombre, descripcion, precio_actual, stock_disponible FROM productos WHERE id_producto = ?";
        
        $stmt = $this->conexion->prepare($sql);
        
        if ($stmt) {
            // El parámetro "i" indica que el valor es un entero (Integer)
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            
            if ($row = $resultado->fetch_assoc()) {
                $producto = new Producto(
                    $row['id_producto'],
                    $row['nombre'],
                    $row['precio_actual'],
                    $row['stock_disponible'],
                    $row['descripcion']
                );
                $stmt->close();
                return $producto;
            }
            $stmt->close();
        }
        
        return null;
    }
    public function incrementarStock($id_producto) {
        $sql = "UPDATE productos SET stock_disponible = stock_disponible + 1 WHERE id_producto = ?";
        
        $stmt = $this->conexion->prepare($sql);
        
        if ($stmt) {
            // El parámetro "i" indica que el valor es un entero (Integer)
            $stmt->bind_param("i", $id_producto);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        }
        
        return false;
    }
    public function decrementarStock($id_producto) {
        $sql = "UPDATE productos SET stock_disponible = stock_disponible - 1 WHERE id_producto = ? AND stock_disponible > 0";
        
        $stmt = $this->conexion->prepare($sql);
        
        if ($stmt) {
            // El parámetro "i" indica que el valor es un entero (Integer)
            $stmt->bind_param("i", $id_producto);
            $resultado = $stmt->execute();
            $stmt->close();
            return $resultado;
        }
        
        return false;
    }
}
?>