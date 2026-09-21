<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

$controller = new CategoriaController();
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizar($_POST['id'], $_POST);
    header('Location: index.php');
    exit;
}

$categoria = $controller->obtenerPorId($id);

if (!$categoria) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <h1>Editar Categoría</h1>
    <div class="users-form">
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">
            <input type="text" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
            <input type="text" name="descripcion" value="<?= htmlspecialchars($categoria['descripcion'] ?? '') ?>">
            <input type="number" step="0.01" name="precio" value="<?= $categoria['precio'] ?>">
            <input type="submit" value="Actualizar">
            <a href="index.php" style="display:inline-block; margin-top:10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>
