<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 
