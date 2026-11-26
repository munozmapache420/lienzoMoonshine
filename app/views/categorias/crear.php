<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

?>
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Crear Categoría</h1>
                <small class="text-secondary">Registra una nueva categoría</small>
            </div>
            <div class="card-body p-4">
    <form action="/categorias" method="POST" class="row g-3">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre de la Categoría:</label>
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre de la categoría" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="descripcion">Descripción:</label>
            <input class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Descripción">
        </div>
        <div class="col-12">
            <label class="form-label" for="precio">Precio de Referencia:</label>
            <input class="form-control" type="number" id="precio" name="precio" value="0" step="0.01" placeholder="Precio de referencia" required>
        </div>
        <div class="col-12 d-grid pt-2">
            <button type="submit" class="btn btn-primary btn-lg">Agregar Categoría</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
