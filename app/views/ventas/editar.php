<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Editar Venta</h1>
                <small class="text-secondary">Actualiza los datos de la venta</small>
            </div>
            <div class="card-body p-4">
    <form action="/ventas/actualizar" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $venta->id ?>">
        <div class="col-md-6">
            <label class="form-label" for="fecha">Fecha</label>
            <input class="form-control" type="date" id="fecha" name="fecha" value="<?= $venta->fecha ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="total">Total</label>
            <input class="form-control" type="number" id="total" name="total" value="<?= $venta->total ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="cliente_id">ID del Cliente</label>
            <input class="form-control" type="number" id="cliente_id" name="cliente_id" value="<?= $venta->cliente_id ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="usuario_id">ID del Usuario</label>
            <input class="form-control" type="number" id="usuario_id" name="usuario_id" value="<?= $venta->usuario_id ?>" required>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
            <a href="/ventas" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
