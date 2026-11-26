<?php
require_once __DIR__ . '/../../../app/controllers/VentaController.php';
?>
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Crear Venta</h1>
                <small class="text-secondary">Registra una nueva venta</small>
            </div>
            <div class="card-body p-4">
    <form action="/ventas" method="POST" class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="fecha">Fecha:</label>
            <input class="form-control" type="date" id="fecha" name="fecha" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="total">Total:</label>
            <input class="form-control" type="number" id="total" name="total" placeholder="Total de la venta" min="0" step="0.01" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="cliente_id">ID del Cliente:</label>
            <input class="form-control" type="number" id="cliente_id" name="cliente_id" placeholder="ID del cliente" min="1" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="usuario_id">ID del Usuario:</label>
            <input class="form-control" type="number" id="usuario_id" name="usuario_id" placeholder="ID del usuario" min="1" required>
        </div>
        <div class="col-12 d-grid pt-2">
            <button type="submit" class="btn btn-primary btn-lg">Agregar Venta</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
