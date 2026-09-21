<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$categorias = $controller->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>

    <nav>
        <a href="../../../public/index.php">Usuarios</a>
        <a href="../productos/index.php">Productos</a>
        <a href="index.php"><strong>Categorías</strong></a>
        <a href="../clientes/index.php">Clientes</a>
        <a href="../ventas/index.php">Ventas</a>
    </nav>

    <h1>Gestión de Categorías</h1>

    <div class="users-form">
        <form action="crear.php" method="POST">
            <h2>Crear Categoría</h2>
            <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
            <input type="text" name="descripcion" placeholder="Descripción">
            <input type="number" step="0.01" name="precio" placeholder="Precio referencia" value="0">
            <input type="submit" value="Agregar Categoría">
        </form>
    </div>

    <h2>Categorías Registradas</h2>

    <div class="users-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categorias)): ?>
                    <?php foreach ($categorias as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><?= htmlspecialchars($c['nombre']) ?></td>
                            <td><?= htmlspecialchars($c['descripcion'] ?? '') ?></td>
                            <td>$<?= number_format((float)$c['precio'], 2) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $c['id'] ?>" class="users-table--edit">Editar</a>
                                <a href="eliminar.php?id=<?= $c['id'] ?>" class="users-table--delete" onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5">No hay categorías registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
