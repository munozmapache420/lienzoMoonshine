<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

$controller = new ProductoController();
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizar($_POST['id'], $_POST);
    header('Location: index.php');
    exit;
}

$producto = $controller->obtenerPorId($id);
$categorias = $controller->categorias();

if (!$producto) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <h1>Editar Producto</h1>

    <div class="users-form">
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($producto['descripcion'] ?? '') ?>">

            <label for="categoria_id">Categoría:</label>
            <select id="categoria_id" name="categoria_id" required>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $producto['categoria_id'] == $c['id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['nombre']) ?></option>
                <?php endforeach; ?>
            </select>

            <label for="precio_compra">Precio de Compra:</label>
            <input type="number" step="0.01" id="precio_compra" name="precio_compra" value="<?= $producto['precio_compra'] ?>" required>

            <label for="precio_venta">Precio de Venta:</label>
            <input type="number" step="0.01" id="precio_venta" name="precio_venta" value="<?= $producto['precio_venta'] ?>" required>

            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" value="<?= $producto['stock'] ?>" required>

            <label for="stock_minimo">Stock Mínimo:</label>
            <input type="number" id="stock_minimo" name="stock_minimo" value="<?= $producto['stock_minimo'] ?>" required>

            <label for="estado">Estado:</label>
            <select id="estado" name="estado">
                <option value="activo" <?= $producto['estado'] == 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="inactivo" <?= $producto['estado'] == 'inactivo' ? 'selected' : '' ?>>Inactivo</option>
            </select>

            <input type="submit" value="Actualizar Producto">
            <a href="index.php" style="display:inline-block; margin-top:10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>
