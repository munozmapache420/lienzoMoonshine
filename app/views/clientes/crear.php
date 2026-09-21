<?php
require_once __DIR__ . '/../../controllers/ClienteController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ClienteController();
    $controller->crear($_POST);
}
header('Location: index.php');
exit;
