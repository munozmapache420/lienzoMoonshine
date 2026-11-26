<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moonshine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/moonshine.css" rel="stylesheet">
</head>
<body>

<?php
 header("content-type: application/html; charset=uft-8");
$rutaActual = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$activo = function ($prefijo) use ($rutaActual) {
    return strpos($rutaActual, $prefijo) === 0 ? ' active' : '';
};
?>
<nav class="navbar navbar-expand-lg bg-primary sticky-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="/productos">&#9790; MOONSHINE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuMoonshine" aria-controls="menuMoonshine" aria-expanded="false" aria-label="Menú">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menuMoonshine">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link<?= $activo('/productos') ?>" href="/productos">Productos</a></li>
                <li class="nav-item"><a class="nav-link<?= $activo('/usuarios') ?>" href="/usuarios">Usuarios</a></li>
                <li class="nav-item"><a class="nav-link<?= $activo('/categorias') ?>" href="/categorias">Categorías</a></li>
                <li class="nav-item"><a class="nav-link<?= $activo('/clientes') ?>" href="/clientes">Clientes</a></li>
                <li class="nav-item"><a class="nav-link<?= $activo('/ventas') ?>" href="/ventas">Ventas</a></li>
                <li class="nav-item"><a class="nav-link<?= $activo('/api/productos') ?>" href="/api/productos">api</a></li>
            </ul>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">＋ Crear</button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/productos/crear">Producto</a></li>
                    <li><a class="dropdown-item" href="/categorias/crear">Categoría</a></li>
                    <li><a class="dropdown-item" href="/usuarios/crear">Usuario</a></li>
                    <li><a class="dropdown-item" href="/ventas/crear">Venta</a></li>
                    <li><a class="dropdown-item" href="/api/productos">Venta</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<main class="container py-4">

<?php
require_once __DIR__ . '/../app/controllers/UsuarioController.php';
require_once __DIR__ . '/../app/controllers/productoController.php';
require_once __DIR__ . '/../app/controllers/ventaController.php';
require_once __DIR__ . '/../app/controllers/categoriaController.php';
require_once __DIR__ . '/../app/controllers/clienteController.php';

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

</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
