<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new UsuarioController();
    $controller->eliminar($id);
}

header('Location: ../../../public/index.php');
exit;
