<?php
require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizar($_POST['id'], $_POST);
    header('Location: index.php');
    exit;
}

$cliente = $controller->obtenerPorId($id);

if (!$cliente) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <h1>Editar Cliente</h1>
    <div class="users-form">
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
            <input type="text" name="nombre" value="<?= ($cliente['nombre']) ?>" required>
            <input type="text" name="telefono" value="<?= ($cliente['telefono'] ?? '') ?>">
            <input type="text" name="direccion" value="<?= ($cliente['direccion'] ?? '') ?>">
            <input type="submit" value="Actualizar">
            <a href="index.php" style="display:inline-block; margin-top:10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>
