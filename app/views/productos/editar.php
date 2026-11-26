<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Editar Producto</h1>
                <small class="text-secondary">Actualiza los datos del producto</small>
            </div>
            <div class="card-body p-4">
    <form action="/productos/actualizar" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $productos->id ?>">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $productos->nombre  ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="descripcion">Descripción</label>
            <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?= $productos->descripcion  ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="categoria_id">Categoría (ID)</label>
            <input class="form-control" type="number" id="categoria_id" name="categoria_id" value="<?= $productos->categoria_id ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="id_inventario">ID de Inventario</label>
            <input class="form-control" type="text" id="id_inventario" name="id_inventario" value="<?= $productos->id_inventario ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="precio_compra">Precio de compra</label>
            <input class="form-control" type="text" id="precio_compra" name="precio_compra" value="<?= $productos->precio_compra  ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="precio_venta">Precio de venta</label>
            <input class="form-control" type="text" id="precio_venta" name="precio_venta" value="<?= $productos->precio_venta ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="stock">Stock</label>
            <input class="form-control" type="text" id="stock" name="stock" value="<?= $productos->stock  ?>" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="stock_minimo">Stock mínimo</label>
            <input class="form-control" type="text" id="stock_minimo" name="stock_minimo" value="<?= $productos->stock_minimo ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label" for="estado">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="activo"> Activo </option>
                <option value="inactivo"> Inactivo </option>
            </select>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
            <a href="/productos" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
