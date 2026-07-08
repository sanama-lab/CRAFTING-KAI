<?php
// carpeta_clases/UsuarioDAO.php
class UsuarioDAO {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    //
    public function registrarUsuario($nombre, $email, $password, $id_tipo) {
        // 1. Validamos si el correo ya está registrado
        $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>alert('El correo ya está registrado.'); window.location.href='registro.php';</script>";
        } else {
            // Insertar nuevo usuario
            $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, email, password, id_tipo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("sssi", $nombre, $email, $password, $id_tipo);

        if ($stmt->execute()) {
            $stmt = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
            $fila = $resultado->fetch_assoc();
            $id_usuario = $fila['id_usuario'];
            $CarritoDAO = new CarritoDAO($this->db);
            $CarritoDAO->crearCarrito($id_usuario);
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.location.href='registro.php';</script>";
        }
    }
    }
    // Método de autenticación 
    public function login($email, $password) {
        // 1. Preparamos la consulta para evitar inyecciones SQL
        $stmt = $this->db->prepare("SELECT id_usuario, nombre, id_tipo, `password` FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            // 2. Verificamos la contraseña 
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
