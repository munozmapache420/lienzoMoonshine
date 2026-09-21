<?php
require_once __DIR__ . '/../../controllers/ClienteController.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $controller = new ClienteController();
    $controller->eliminar($id);
}

header('Location: index.php');
exit;
