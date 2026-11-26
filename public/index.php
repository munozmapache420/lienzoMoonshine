<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/productoController.php';
require_once __DIR__ . '/../app/controllers/ventaController.php';
require_once __DIR__ . '/../app/controllers/categoriaController.php';
require_once __DIR__ . '/../app/controllers/clienteController.php';
require_once __DIR__ . '/../app/controllers/homeController.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$ruta = parse_url($uri, PHP_URL_PATH);

$rutas = require dirname(__DIR__) . '/rutas/web.php';

$enrutamiento = $rutas[$method][$ruta] ?? null;

if ($enrutamiento !== null) {
    $nControlador = $enrutamiento[0];
    $nMetodo = $enrutamiento[1];

    $controlador = new $nControlador();
    $controlador->$nMetodo();
} else {
    http_response_code(404);
    echo "404 - Página no encontrada";
}
?>