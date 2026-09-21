<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new CategoriaController();
    $controller->eliminar($id);
}

header('Location: index.php');
exit;
