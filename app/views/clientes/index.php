<?php
require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();
$clientes = $controller->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Clientes</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>

    <nav>
        <a href="../../../public/index.php">Usuarios</a>
        <a href="../productos/index.php">Productos</a>
        <a href="../categorias/index.php">Categorías</a>
        <a href="index.php"><strong>Clientes</strong></a>
        <a href="../ventas/index.php">Ventas</a>
    </nav>

    <h1>Gestión de Clientes</h1>

    <div class="users-form">
        <form action="crear.php" method="POST">
            <h2>Registrar Cliente</h2>
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="text" name="telefono" placeholder="Teléfono">
            <input type="text" name="direccion" placeholder="Dirección">
            <input type="submit" value="Agregar Cliente">
        </form>
    </div>

    <h2>Clientes Registrados</h2>

    <div class="users-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Registro Único</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['telefono'] ?? '') ?></td>
                            <td><?= htmlspecialchars($c['direccion'] ?? '') ?></td>
                            <td><?= htmlspecialchars($c['registro_unico']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $c['id'] ?>" class="users-table--edit">Editar</a>
                                <a href="eliminar.php?id=<?= $c['id'] ?>" class="users-table--delete" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
