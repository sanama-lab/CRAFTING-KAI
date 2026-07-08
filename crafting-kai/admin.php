<?php
require_once 'config.php';
if (!isset($_SESSION['id']) && $_SESSION['id_tipo'] != 3) {
    header('Location: index.php');
    exit();
}

$userDAO = new UsuarioDAO($conn);
$resultado = $userDAO->obtenerTodoUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Usuarios</title>
     <link rel="stylesheet" href="style2.css"> 
</head>
<body>

    <div class="contenedor">
        <div class="encabezado">
            <h1>Lista de <span>Usuarios</span></h1>
            <a href="index.php" class="btn-volver">← Volver al Inicio</a>
        </div>

        <div class="tabla-contenedor">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Código para obtener y mostrar los usuarios
                    foreach ($resultado as $Usuario) { if ($Usuario->getRol() == '3') continue; // Saltar al siguiente usuario si es admin 
                    ?>
                    <tr>
                        <td class="user-id"><?php echo htmlspecialchars($Usuario->getId()); ?></td>
                        <td class="user-nombre"><?php echo htmlspecialchars($Usuario->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($Usuario->getEmail()); ?></td>
                        <td><span <?php echo $Usuario->getRol() === '2' ? 'class="rol admin"' : 'class="rol cliente"'; ?>><?php echo htmlspecialchars($Usuario->getRol() === '2' ? 'empleado' : 'Cliente'); ?></span></td>
                        <td class="acciones">
                            <?php if ($Usuario->getRol() === '2') {
                                //llamar al metodo para cambiar el rol del usuario ?>
                                <a class="btn-accion btn-editar " href="cambiarausuario.php?id=<?php echo $Usuario->getId(); ?>">hacer usuario</a>
                                <?php } else {?>
                                <a class="btn-accion btn-editar" href="cambiaraempleado.php?id=<?php echo $Usuario->getId(); ?>">hacer empleado</a>
                            <?php } ?>
                            <a class="btn-accion btn-eliminar" href="eliminarUsuario.php?id=<?php echo $Usuario->getId(); ?>" data-id="<?php echo $Usuario->getId(); ?>">Eliminar</a>
                        </td>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>