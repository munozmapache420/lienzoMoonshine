<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/productoController.php';
require_once __DIR__ . '/../app/controllers/ventaController.php';
require_once __DIR__ . '/../app/controllers/categoriaController.php';
require_once __DIR__ . '/../app/controllers/clienteController.php';

/* $controller = new UsuarioController();
$usuarios = $controller->index();
$roles = $controller->roles(); */

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if ($method === 'GET' && $uri === '/productos') {

    $productoController = new productoController();
    $productoController->index();

}

if ($method === 'GET' && $uri === '/usuarios') {

    $usuarioController = new UsuarioController();
    $usuarioController->index();

}

if ($method === 'GET' && $uri === '/categorias') {

    $categoriaController = new categoriaController();
    $categoriaController->index();

}

if ($method === 'GET' && $uri === '/ventas') {

    $ventaController = new ventaController();
    $ventaController->index();

}
if ($method === 'GET' && $uri === '/clientes') {

    $clienteController= new clienteController();
    $clienteController->index();

}

?>
<a href="/productos">productos</a>
<a href="/usuarios">usuarios</a>
<a href="/categorias">categorias</a>
<a href="/clientes">clientes</a>

 <!-- <!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Moonshine · Gestión del Sistema</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body> -->
<!-- 
<nav>
    <a href="index.php"><strong>Usuarios</strong></a>
    <a href="../app/views/productos/index.php">Productos</a>
    <a href="../app/views/categorias/index.php">Categorías</a>
    <a href="../app/views/clientes/index.php">Clientes</a>
    <a href="../app/views/ventas/index.php">Ventas</a>
</nav> -->

<!-- <h1>Gestión de Usuarios</h1>

<div class="users-form">
    <form action="../app/views/usuarios/crear.php" method="POST">
        <h2>Crear Usuario</h2>
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="correo" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <input type="text" name="cargo" placeholder="Cargo (opcional)">
        <select name="rol_id" required>
            <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>"><?= ($r['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Agregar Usuario">
    </form>
</div>

<h2>Usuarios Registrados</h2>

<div class="users-table">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Cargo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= ($u['nombre']) ?></td>
                        <td><?= ($u['correo']) ?></td>
                        <td><?= ($u['cargo'] ?? '') ?></td>
                        <td><?= ($u['rol_nombre'] ?? '') ?></td>
                        <td>
                            <a href="../app/views/usuarios/editar.php?id=<?= $u['id'] ?>" class="users-table--edit">Editar</a>
                            <a href="../app/views/usuarios/eliminar.php?id=<?= $u['id'] ?>" class="users-table--delete" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="6">No hay usuarios registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html> -->
