<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new ProductoController();
    $controller->eliminar($id);
}

header('Location: index.php');
exit;
