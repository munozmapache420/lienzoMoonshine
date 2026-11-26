<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h2 mb-1 text-primary">Gestión de Usuarios</h1>
        <p class="text-secondary mb-0">Usuarios Registrados</p>
    </div>
        <a href="/usuarios/crear" class="btn btn-primary">＋ Nuevo usuario</a>
</div>

<?php if (!empty($usuarios)): ?>

    <div class="card border-secondary shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Usuarios Registrados</span>
            <span class="badge rounded-pill text-bg-primary">Total: <?= count($usuarios) ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Password</th>
                        <th>Cargo</th>
                        <th>Activo</th>
                        <th>Rol ID</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><span class="fw-semibold"><?= $u['nombre'] ?></span></td>
                            <td><?= $u['correo'] ?></td>
                            <td><?= $u['password'] ?></td>
                            <td><?= $u['cargo'] ?></td>
                            <td><span class="badge <?= $u['activo'] == 1 ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $u['activo'] ?></span></td>
                            <td><?= $u['rol_id'] ?></td>
                            <td class="text-nowrap">
                                <a href="/usuarios/editar?id=<?= $u['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="/usuarios/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este registro?')">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
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
        No hay usuarios registrados.
    </div>

<?php endif; ?>
