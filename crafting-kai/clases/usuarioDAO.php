<?php
// carpeta_clases/UsuarioDAO.php
class UsuarioDAO {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }
    // Método de autenticación (Aquí movemos tu lógica de login)
    public function login($email, $password) {
        // 1. Preparamos la consulta para evitar inyecciones SQL
        $stmt = $this->db->prepare("SELECT id_usuario, nombre, id_tipo, `password` FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            // 2. Verificamos la contraseña (asumiendo que usas password_hash)
            if (password_verify($password, $fila['password'])) {
                // 3. Retornamos un objeto Usuario lleno con los datos
                return new Usuario($fila['id_usuario'], $fila['nombre'], $email, $fila['id_tipo']);
            }
        }
        
        // Si falla, retornamos false
        return false;
    }
    public function obtenerTodoUsuarios() {
        $sql = "SELECT id_usuario, nombre, email, id_tipo FROM usuarios";
        $resultado = $this->db->query($sql);
        
        $usuarios = [];
        
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $usuarios[] = new Usuario($fila['id_usuario'], $fila['nombre'], $fila['email'], $fila['id_tipo']);
            }
            // Liberamos el resultado de la memoria
            $resultado->free();
        }
        
        return $usuarios;
    }
    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT id_usuario, nombre, email, id_tipo FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            return new Usuario($fila['id_usuario'], $fila['nombre'], $fila['email'], $fila['id_tipo']);
        }
        
        return null; // Retorna null si no se encuentra el usuario
    }
    public function borrarUsuarioPorId($id) {
        $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function cambiarRolUsuario($id, $nuevoRol) {
        $sql = "UPDATE usuarios SET id_tipo = ? WHERE id_usuario = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ii", $nuevoRol, $id);
        return $stmt->execute();
    }
    
}
