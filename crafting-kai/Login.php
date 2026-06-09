<?php
include 'db.php';
session_start();
// Línea para la ñ
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Verificar credenciales
    $stmt = $conn->prepare("SELECT id_usuario, nombre, id_tipo, `password` FROM usuarios WHERE email = ? ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        // 2. VERIFICAR CONTRASEÑA
        if (password_verify($pass, $usuario['password'])) {
            $_SESSION['id']   = $usuario['id_usuario'];
            $_SESSION['user'] = $usuario['nombre'];
            $_SESSION['rol']  = $usuario['id_tipo'];
            $_SESSION['mail'] = $email; // Guardamos el email en sesión para futuras referencias
            
            header("Location: index.php?login=success");
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }   
    } else {
        $error = "El correo no está registrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Crafting-Kai</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php if (isset($error)) {
        echo "<script>alert('$error');</script>";
    } ?>
</head>
<body>
    <header class="main-header">
        <div class="container header-container">
            <div class="site-title">
                <a href="index.php"><h1>Crafting-<span>Kai</span> Mercado online</h1></a>
            </div>
            <nav class="header-actions">
                <a href="index.php" class="btn-action"><i class="fas fa-home"></i> Volver al Inicio</a>
            </nav>
        </div>
    </header>

    <main class="auth-container">
        <div class="auth-card">
            <h2>Bienvenido de Nuevo</h2>
            <p>Ingresa a tu cuenta de impresión 3D</p>
            <form class="auth-form" action="login.php" method="POST">
                <div class="form-group">
                    <label><i class="fas fa-envelope"></i> Correo Electrónico</label>
                    <input type="email" name="email" placeholder="tu@ejemplo.com" required>
                </div>
                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Contraseña</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-primary">
                    Iniciar Sesión
                </button>
            </form>
            <div class="auth-footer">
                <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
            </div>
        </div>
    </main>
</body>
</html>