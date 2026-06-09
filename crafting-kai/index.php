<?php
include 'db.php';
session_start();
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
            <a href="usuario.php" class="user-profile">
                <?php if (isset($_SESSION['id'])) { ?>
                    <div class="user-avatar">
                        <img src="foto de ivan.jpg" alt="Avatar de Usuario">
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
                    <img src="foto de ivan.jpg" alt="Avatar de Usuario">
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
                <div class="product-card">
                    <div class="product-image">
                        <img src="labubu3D.webp" alt="Producto 1">
                        <span class="product-badge">Nuevo</span>
                    </div>
                    <div class="product-details">
                        <h3>Figura Labubu</h3>
                        <p class="product-description">Figura detallada de Labubu impresa en PLA de alta calidad, con excelente nivel de acabado y perfecta para coleccionistas.</p>
                        <div class="product-meta">
                            <span class="product-price">$32.000</span>
                            <button class="btn-add-cart" data-id="1" data-name="Figura Labubu" data-price="32000" data-image="labubu3D.webp"> <i class="fas fa-cart-plus"></i></button>

                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="porta auriculares.webp" alt="Producto 2">
                    </div>
                    <div class="product-details">
                        <h3>Soporte para Auriculares Gamer</h3>
                        <p class="product-description">Soporte gamer resistente y moderno, ideal para mantener tus auriculares organizados y cuidar tu espacio de trabajo.</p>
                        <div class="product-meta">
                            <span class="product-price">$18.000</span>
                            <button class="btn-add-cart" data-id="1" data-name="Soporte para Auriculares Gamer" data-price="18000" data-image="Soporte para Auriculares Gamer3D.webp"> <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="Maseta geometrica.webp" alt="Producto 3">
                    </div>
                    <div class="product-details">
                        <h3>Maceta Geométrica</h3>
                        <p class="product-description">Maceta decorativa con diseño geométrico, perfecta para suculentas y espacios minimalistas.</p>
                        <div class="product-meta">
                           <span class="product-price">$14.000</span>
                           <button class="btn-add-cart" data-id="1" data-name="Maceta Geométrica" data-price="14000" data-image="Maceta Geométrica3D.webp"> <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="set de engranajes.jfif" alt="Producto 4">
                    </div>
                    <div class="product-details">
                        <h3>Set de Engranajes</h3>
                       <p class="product-description">Engranajes impresos en material de alta resistencia, ideales para proyectos mecánicos y vehículos RC.</p>
                        <div class="product-meta">
                            <span class="product-price">$22.000</span>
                            <button class="btn-add-cart" data-id="1" data-name="Set de Engranajes" data-price="22000" data-image="Set de Engranajes3D.webp"> <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                 <div class="product-card">
                    <div class="product-image">
                        <img src="Porta llaves.jfif" alt="Producto 5">
                    </div>
                    <div class="product-details">
                        <h3>Llavero Personalizado</h3>
                        <p class="product-description">Sube tu diseño y lo imprimimos.</p>
                        <div class="product-meta">
                            <span class="product-price">$10.000</span>
                            <button class="btn-add-cart" data-id="1" data-name="Llavero Personalizado" data-price="10000" data-image="Llavero Personalizado3D.webp"> <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="Batman.jfif" alt="Producto 6">
                        <span class="product-badge sale">Oferta</span>
                    </div>
                    <div class="product-details">
                        <h3>Coleccionable Batman</h3>
                        <p class="product-description">Pintado a mano (opcional).</p>
                        <div class="product-meta">
                            <span class="product-price"><del>$55.000</del> $42.000</span>
                            <button class="btn-add-cart" data-id="1" data-name="Coleccionable Batman" data-price="42000" data-image="Coleccionable Batman3D.webp"> <i class="fas fa-cart-plus"></i></button>
                        </div>
                    </div>
                </div>

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