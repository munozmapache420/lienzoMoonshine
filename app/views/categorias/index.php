<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h2 mb-1 text-primary">Gestión de Categorías</h1>
        <p class="text-secondary mb-0">Categorías Registradas</p>
    </div>
        <a href="/categorias/crear" class="btn btn-primary">＋ Nueva categoría</a>
</div>

<?php if (!empty($categorias)): ?>

    <div class="card border-secondary shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Categorías Registradas</span>
            <span class="badge rounded-pill text-bg-primary">Total: <?= count($categorias) ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categorias as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td><span class="fw-semibold"><?= $c['nombre'] ?></span></td></td>
                            <td><?= $c['descripcion'] ?></td>
                            <td>$<?= number_format((float)$c['precio'], 2, ',', '.') ?></td>
                            <td class="text-nowrap">
                                <a href="/categorias/editar?id=<?= urlencode($c['id']) ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="/categorias/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este registro?')">
                                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php else: ?>

    <div class="alert alert-secondary text-center" role="alert">
        No hay categorías registradas.
    </div>

<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/../../css/style.css">
</head>
<body>
    
</body>
</html>