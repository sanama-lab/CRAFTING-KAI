<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    // si es empleado el checkbox estará marcado, entonces id_tipo será 2, de lo contrario 1
    $id_tipo = isset($_POST['es_empleado']) ? 2 : 1;
    // Verificar si el correo ya existe
    $stmt = $conn->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('El correo ya está registrado.'); window.location.href='registro.php';</script>";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, id_tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre, $email, $password, $id_tipo);
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.location.href='registro.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - 3DPrint Mercado</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="main-header">
        <div class="container header-container">
            <div class="site-title">
                <a href="index.php"><h1>3D<span>Print</span> Mercado</h1></a>
            </div>
            <nav class="header-actions">
                <a href="index.php" class="btn-action"><i class="fas fa-home"></i> Volver al Inicio</a>
            </nav>
        </div>
    </header>

    <main class="auth-container">
        <div class="auth-card">
            <h2>Crear Cuenta</h2>
            <p>Únete a la comunidad de creadores 3D</p>
            <form class="auth-form" action="registro.php" method="POST">
                
                <div class="form-group">
                    <label><i class="fas fa-user"></i> Nombre Completo</label>
                    <input type="text" name="nombre" placeholder="Ej. Juan Pérez" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" name="email" placeholder="tu@ejemplo.com" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" name="password" placeholder="Crea una clave segura" required>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="es_empleado" name="es_empleado" value="1">
                    <label for="es_empleado">Registrar como Empleado</label>
                </div>
                <button type="submit" class="btn-primary accent-green-btn">Crear Cuenta</button>
            </form>
        
            <div class="auth-footer">
                <p>¿Ya eres miembro? <a href="login.php">Inicia sesión</a></p>
            </div>
        
        </div>
    </main>
</body>
</html>