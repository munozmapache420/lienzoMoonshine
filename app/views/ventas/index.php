<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h2 mb-1 text-primary">Gestión de Ventas</h1>
        <p class="text-secondary mb-0">Ventas Registradas</p>
    </div>
        <a href="/ventas/crear" class="btn btn-primary">＋ Nueva venta</a>
</div>

<?php if (!empty($ventas)): ?>

    <div class="card border-secondary shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Ventas Registradas</span>
            <span class="badge rounded-pill text-bg-primary">Total: <?= count($ventas) ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Cliente ID</th>
                        <th>Usuario ID</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ventas as $v): ?>
                        <tr>
                            <td><?= $v['id'] ?></td>
                            <td><?= $v['fecha'] ?></td>
                            <td><?= $v['total'] ?></td>
                            <td><?= $v['cliente_id'] ?></td>
                            <td><?= $v['usuario_id'] ?></td>
                            <td class="text-nowrap">
                                <a href="/ventas/editar?id=<?= $v['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="/ventas/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este registro?')">
                                    <input type="hidden" name="id" value="<?= $v['id'] ?>">
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
        No hay ventas registradas.
    </div>

<?php endif; ?>
