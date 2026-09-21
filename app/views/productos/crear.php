<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ProductoController();
    $controller->crear($_POST);
}
header('Location: index.php');
exit;
