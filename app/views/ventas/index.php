<?php
require_once __DIR__ . '/../../controllers/VentaController.php';

$controller = new VentaController();
$ventas = $controller->index();
$productos = $controller->productos();
$clientes = $controller->clientes();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>

    <nav>
        <a href="../../../public/index.php">Usuarios</a>
        <a href="../productos/index.php">Productos</a>
        <a href="../categorias/index.php">Categorías</a>
        <a href="../clientes/index.php">Clientes</a>
        <a href="index.php"><strong>Ventas</strong></a>
    </nav>

    <h1>Registrar Venta</h1>

    <div class="users-form">
        <form action="crear.php" method="POST">
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id">
                <option value="">-- Sin cliente --</option>
                <?php foreach ($clientes as $c): ?>
                    <option value="<?= $c['id'] ?>"><?= ($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" required>
                <?php foreach ($productos as $p): ?>
                    <option value="<?= $p['id'] ?>">
                        <?= ($p['nombre']) ?> — $<?= number_format((float)$p['precio_venta'], 2) ?> (stock: <?= $p['stock'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

            <label for="metodo_pago">Método de Pago:</label>
            <select name="metodo_pago" id="metodo_pago" required>
                <option value="Efectivo">Efectivo</option>
                <option value="Transferencia">Transferencia</option>
                <option value="Tarjeta">Tarjeta</option>
            </select>

            <input type="submit" value="Registrar Venta">
        </form>
    </div>

    <h2>Ventas Registradas</h2>

    <div class="users-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ventas)): ?>
                    <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><?= $v['id'] ?></td>
                            <td><?= htmlspecialchars($v['cliente_nombre'] ?? 'Sin cliente') ?></td>
                            <td><?= htmlspecialchars($v['usuario_nombre'] ?? '') ?></td>
                            <td><?= $v['fecha'] ?></td>
                            <td>$<?= number_format((float)$v['total'], 2) ?></td>
                            <td><?= $v['anulada'] ? 'Anulada' : 'Activa' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay ventas registradas.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
