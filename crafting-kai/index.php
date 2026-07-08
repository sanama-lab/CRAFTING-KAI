<?php
require_once 'config.php';
$conn = new ProductoDAO($conn);
$Productos = $conn->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3DPrint Mercado - Tu Tienda de Impresiones 3D</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <?php if (isset($_GET['login']) && $_GET['login'] === 'success') { ?>
        <script>
            alert('¡BIENBENIDO, <?php echo $_SESSION['user']; ?>! HAS INICIADO SESIÓN CORRECTAMENTE.');
        </script>
    <?php } ?>
</head>
<body>

    <header class="main-header">
        <div class="container header-container">
            <a href="info.php" class="user-profile">
                <?php if (isset($_SESSION['id'])) { ?>
                    <div class="user-avatar">
                        <img src="https://cdn-icons-png.flaticon.com/128/310/310818.png" alt="Avatar de Usuario">
                    </div>
                    <div class="user-info">
                        <span class="user-name" >
                            <?php echo $_SESSION['user']; ?>
                        </span>
                        <span class="user-status" id="user-status">
                            sesion iniciada 
                        </span>
                    </div>
                <?php } else { ?>
            <div class="user-profile"> 
                <div class="user-avatar">
                    <img src="img/foto de ivan.jpg" alt="Avatar de Usuario">
                </div>
                <div class="user-info">
                    <span class="user-name" >
                        Invitado
                    </span>
                    
                    <span class="user-status" >
                        Sin iniciar sesión
                    </span>
                </div>
            </div>
                <?php } ?>
            </a>
            <div class="site-title">
                <h1>Crafting-<span>Kai</span> Mercado online</h1>
                 <h4>Pagina oficial</h4>
            </div>

            <nav class="header-actions">
                <?php if (isset($_SESSION['id'])) { ?>
                    <a href="logout.php" class="btn-action"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    <a href="Carrito.php" class="btn-action cart-btn"><i class="fas fa-shopping-cart"></i> Carrito <span class="cart-count">0</span></a>
                <?php if ($_SESSION['rol'] == 3) { ?>
                    <a href="admin.php" class="btn-action"><i class="fas fa-user-shield"></i> Panel Admin</a>
                <?php } ?>
                <?php } else { ?>
                    <a href="Login.php" class="btn-action"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
                    <a href="Registro.php" class="btn-action"><i class="fas fa-user-plus"></i> Registrarse</a>
                <?php } ?>
            </nav>
        </div>
    </header>

    <nav class="category-bar">
        <div class="container category-container">
            <a href="#" class="category-item active">Todos</a>
            <a href="#" class="category-item">Accesorios</a>
            <a href="#" class="category-item">Juguetes</a>
            <a href="#" class="category-item">Maquetas</a>
            <a href="#" class="category-item">Hogar</a>
            <a href="#" class="category-item">Repuestos</a>
            <a href="#" class="category-item">Arte</a>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            <h2 class="section-title">Catálogo Destacado</h2>
            
            <div class="product-grid">
                <?php foreach ($Productos as $producto) { ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="img/<?php if ($producto->getid() == 1){echo'labubu3D.webp';} elseif ($producto->getid() == 2){echo'porta auriculares.webp';} elseif ($producto->getid() == 3){echo'Maseta geometrica.webp';} elseif ($producto->getid() == 4){echo'set de engranajes.jfif';} elseif ($producto->getid() == 5){echo'Porta llaves.jfif';} elseif ($producto->getid() == 6){echo 'batman.jfif';} ?>" alt="<?php echo $producto->getNombre(); ?>">
                        </div>
                    <div class="product-details">
                        <h3><?php echo $producto->getNombre(); ?></h3>
                        <p class="product-description"><?php echo $producto->getDescripcion(); ?></p>
                        <div class="product-meta">
                            <span class="product-price"><?php echo $producto->getPrecio(); ?> -- Stock: <?php echo $producto->getStock(); ?></span>
                            <?php if ($producto->getStock() <= 0) { ?>
                                <span class="out-of-stock">Agotado</span>
                            <?php } ?>
                            <?php if ($_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) { ?>
                                <a class="btn-add-cart" href="incrementarstock.php?id=<?php echo $producto->getid(); ?>"><i class="fa-solid fa-plus"></i></a>
                            <?php } ?>
                            <a class="btn-add-cart" href="agregarProducto.php?id=<?php echo $producto->getid(); ?>"><i class="fas fa-cart-plus"></i></a>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </main>

    <footer class="main-footer">
    <div class="container footer-container">

        <div class="footer-section">
            <h3>Crafting-Kai</h3>
            <p>Impresiones 3D personalizadas de alta calidad. Diseñamos, creamos y hacemos realidad tus ideas.</p>
        </div>

        <div class="footer-section">
            <h4>Contacto</h4>
            <p><i class="fas fa-envelope"></i> craftingkai@gmail.com</p>
            <p><i class="fas fa-phone"></i> +54 11 1234-5678</p>
        </div>

        <div class="footer-section">
            <h4>Información</h4>
            <a href="#">Sobre Nosotros</a>
            <a href="#">Términos de Servicio</a>
            <a href="#">Política de Privacidad</a>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; 2026 Crafting-Kai. Todos los derechos reservados a Joaquin Adrian Maini y su equipo.</p>
    </div>
</footer>
</body>
</html>