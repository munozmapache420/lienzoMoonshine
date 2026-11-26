<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Editar Categoría</h1>
                <small class="text-secondary">Actualiza los datos de la categoría</small>
            </div>
            <div class="card-body p-4">
    <form action="/categorias/actualizar" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $categoria->id ?>">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $categoria->nombre ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="descripcion">Descripción</label>
            <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?= $categoria->descripcion ?>">
        </div>
        <div class="col-12">
            <label class="form-label" for="precio">Precio de referencia</label>
            <input class="form-control" type="number" id="precio" name="precio" value="<?= $categoria->precio ?>" required>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
            <a href="/categorias" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
