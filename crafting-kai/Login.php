<?php
require_once 'config.php';

// Línea para la ñ
$conn->set_charset("utf8mb4");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dao = new UsuarioDAO($conn);
    $carritoDAO = new CarritoDAO($conn);
    $Usuario = $dao->login($_POST['email'], $_POST['password']);
    if ($Usuario) {
        $_SESSION['id']   = $Usuario->getId();
        $_SESSION['user'] = $Usuario->getNombre();
        $_SESSION['rol']  = $Usuario->getRol();
        $_SESSION['mail'] = $Usuario->getEmail(); // Guardamos el email en sesión para futuras referencias
        $_SESSION['carrito'] = $carritoDAO->obtenerCarritoPorId($Usuario->getId());
        header("Location: index.php?login=success");
        exit();
    } else {
        $error = "Contraseña incorrecta.";
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
    <?php 
    if (isset($error)) {
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