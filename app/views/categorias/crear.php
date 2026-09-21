<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new CategoriaController();
    $controller->crear($_POST);
}
header('Location: index.php');
exit;
