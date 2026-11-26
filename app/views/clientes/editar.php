<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Editar Cliente</h1>
                <small class="text-secondary">Actualiza los datos del cliente</small>
            </div>
            <div class="card-body p-4">
    <form action="/clientes/actualizar" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $cliente->id ?>">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $cliente->nombre ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="telefono">Teléfono</label>
            <input class="form-control" type="text" id="telefono" name="telefono" value="<?= $cliente->telefono ?>">
        </div>
        <div class="col-12">
            <label class="form-label" for="direccion">Dirección</label>
            <input class="form-control" type="text" id="direccion" name="direccion" value="<?= $cliente->direccion ?>">
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
            <a href="/clientes" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
