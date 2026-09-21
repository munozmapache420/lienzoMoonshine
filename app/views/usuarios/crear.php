<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UsuarioController();
    $controller->crear($_POST);
    header('Location: ../../../public/index.php');
    exit;
}
header('Location: ../../../public/index.php');
exit;
