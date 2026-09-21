<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

$controller = new UsuarioController();
$id = $_GET['id'] ?? $_POST['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->actualizar($_POST['id'], $_POST);
    header('Location: ../../../public/index.php');
    exit;
}

$usuario = $controller->obtenerPorId($id);
$roles = $controller->roles();

if (!$usuario || !$usuario['id']) {
    header('Location: ../../../public/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <h1>Editar Usuario</h1>
    <div class="users-form">
        <form action="editar.php" method="POST">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
            <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
            <input type="password" name="password" value="<?= htmlspecialchars($usuario['password']) ?>" required>
            <input type="text" name="cargo" value="<?= htmlspecialchars($usuario['cargo'] ?? '') ?>" placeholder="Cargo">
            <select name="rol_id" required>
                <?php foreach ($roles as $r): ?>
                    <option value="<?= $r['id'] ?>" <?= $usuario['rol_id'] == $r['id'] ? 'selected' : '' ?>><?= htmlspecialchars($r['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Actualizar">
            <a href="../../../public/index.php" style="display:inline-block; margin-top:10px;">Cancelar</a>
        </form>
    </div>
</body>
</html>
