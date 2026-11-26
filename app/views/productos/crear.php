<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

?>
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Crear Producto</h1>
                <small class="text-secondary">Registra un nuevo producto</small>
            </div>
            <div class="card-body p-4">
    <form action="/productos" method="POST" class="row g-3">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre del Producto:</label>
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="descripcion">Descripción:</label>
            <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Descripción">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="categoria_id">ID de Categoría:</label>
            <input class="form-control" type="number" id="categoria_id" name="categoria_id" placeholder="ID de categoría" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="id_inventario">ID de Inventario:</label>
            <input class="form-control" type="number" id="id_inventario" name="id_inventario" placeholder="ID del inventario">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="precio_compra">Precio de Compra:</label>
            <input class="form-control" type="number" id="precio_compra" name="precio_compra" step="0.01" placeholder="Ej: 15000" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="precio_venta">Precio de Venta:</label>
            <input class="form-control" type="number" id="precio_venta" name="precio_venta" step="0.01" placeholder="Ej: 25000" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="stock">Stock:</label>
            <input class="form-control" type="number" id="stock" name="stock" placeholder="Cantidad / Stock" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="stock_minimo">Stock Mínimo:</label>
            <input class="form-control" type="number" id="stock_minimo" name="stock_minimo" value="0" required>
        </div>
        <div class="col-md-4">
            <label class="form-label" for="sizesSelectSmall">Estado:</label>
            <select class="form-select" id="sizesSelectSmall">
                <option value="activo"> Activo </option>
                <option value="inactivo"> Inactivo </option>
            </select>
        </div>
        <div class="col-12 d-grid pt-2">
            <button type="submit" class="btn btn-primary btn-lg">Agregar Producto</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
