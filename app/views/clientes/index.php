<div class="mb-4">
    <h1 class="h2 mb-1 text-primary">Gestión de Clientes</h1>
    <p class="text-secondary mb-0">Clientes Registrados</p>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-12 col-lg-8">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3"><h2 class="h5 mb-0 text-primary">Registrar Cliente</h2></div>
            <div class="card-body p-4">
                <form action="crear.php" method="POST" class="row g-3">
                    <div class="col-md-4"><input class="form-control" type="text" name="nombre" placeholder="Nombre completo" required></div>
                    <div class="col-md-3"><input class="form-control" type="text" name="telefono" placeholder="Teléfono"></div>
                    <div class="col-md-3"><input class="form-control" type="text" name="direccion" placeholder="Dirección"></div>
                    <div class="col-md-2 d-grid"><input class="btn btn-primary" type="submit" value="Agregar Cliente"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card border-secondary shadow-lg">
    <div class="card-header fw-semibold">Clientes Registrados</div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Registro Único</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= $c['id'] ?></td>
                            <td class="fw-semibold"><?= ($c['nombre']) ?></td>
                            <td><?= ($c['telefono'] ?? '') ?></td>
                            <td><?= ($c['direccion'] ?? '') ?></td>
                            <td><?= ($c['registro_unico']) ?></td>
                            <td class="text-nowrap">
                                <a href="/clientes/editar?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <a href="eliminar.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center text-secondary py-4">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
