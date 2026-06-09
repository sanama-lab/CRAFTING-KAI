<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
   
<header class="main-header">

    <div class="container header-container">

        <div class="site-title">
            <a href="index.php">
                <h1>Crafting-<span>Kai</span></h1>
            </a>
        </div>

    </div>
</header>

<main class="auth-container">

    <div class="auth-card">

        <h2>Perfil de Usuario</h2>

        <div class="form-group">
            <label>Nombre</label>

            <input type="text" id="perfil-nombre" disabled>
        </div>

        <div class="form-group">
            <label>Correo</label>

            <input type="email" id="perfil-email" disabled>
        </div>

        <div class="form-group">
            <label>Contraseña</label>

            <div style="display:flex; gap:10px;">

                <input type="password"
                id="perfil-password"
                disabled
                style="flex:1;">

                <button type="button"
                id="toggle-password"
                class="btn-action">

                    <i class="fas fa-eye"></i>

                </button>

            </div>
        </div>

        <button id="logout-btn"
        class="btn-primary"
        style="margin-top:20px;">

            Cerrar Sesión
        </button>
        <nav class="header-actions">
            <a href="index.php" class="btn-action"><i class="fas fa-home"></i> Volver al Inicio</a>
        </nav>
    </div>

</main>

</body>
</html>
