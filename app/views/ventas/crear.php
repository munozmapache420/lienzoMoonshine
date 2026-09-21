<?php
session_start();
require_once __DIR__ . '/../../controllers/VentaController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new VentaController();

    // Si no hay sesión de usuario iniciada, se usa el primer usuario del sistema.
    $usuarioId = $_SESSION['usuario_id'] ?? 1;

    $controller->registrarVentaCompleta([
        'cliente_id'  => !empty($_POST['cliente_id']) ? (int)$_POST['cliente_id'] : null,
        'usuario_id'  => $usuarioId,
        'metodo_pago' => $_POST['metodo_pago'] ?? 'Efectivo',
        'productos'   => [
            ['id' => (int)$_POST['producto_id'], 'cantidad' => (int)$_POST['cantidad']]
        ]
    ]);
}
header('Location: index.php');
exit;
