<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

$controller = new ProductoController();
$productos = $controller->index();
$categorias = $controller->categorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>

    <nav>
        <a href="../../../public/index.php">Usuarios</a>
        <a href="index.php"><strong>Productos</strong></a>
        <a href="../categorias/index.php">Categorías</a>
        <a href="../clientes/index.php">Clientes</a>
        <a href="../ventas/index.php">Ventas</a>
    </nav>

    <h1>Gestión de Productos</h1>

    <div class="users-form">
        <form action="crear.php" method="POST">
            <h2>Crear Producto</h2>
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" placeholder="Descripción">

            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= ($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="precio_compra">Precio de Compra:</label>
            <input type="number" step="0.01" id="precio_compra" name="precio_compra" placeholder="Ej: 15000" required>

            <label for="precio_venta">Precio de Venta:</label>
            <input type="number" step="0.01" id="precio_venta" name="precio_venta" placeholder="Ej: 25000" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" placeholder="Cantidad / Stock" required>

            <label for="stock_minimo">Stock Mínimo:</label>
            <input type="number" id="stock_minimo" name="stock_minimo" value="0" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>

            <input type="submit" value="Agregar Producto">
        </form>
    </div>

    <h2>Productos Registrados</h2>

    <div class="users-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Compra</th>
                    <th>Venta</th>
                    <th>Stock</th>
                    <th>Stock Mín.</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($productos)): ?>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= $p['id'] ?></td>
                            <td><?= htmlspecialchars($p['nombre']) ?></td>
                            <td><?= htmlspecialchars($p['categoria_nombre'] ?? '') ?></td>
                            <td>$<?= number_format((float)$p['precio_compra'], 2) ?></td>
                            <td>$<?= number_format((float)$p['precio_venta'], 2) ?></td>
                            <td><?= $p['stock'] ?></td>
                            <td><?= $p['stock_minimo'] ?></td>
                            <td><?= ($p['estado']) ?></td>
                            <td>
                                <a href="editar.php?id=<?= $p['id'] ?>" class="users-table--edit">Editar</a>
                                <a href="eliminar.php?id=<?= $p['id'] ?>" class="users-table--delete" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9">No hay productos registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
