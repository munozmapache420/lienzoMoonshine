<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

?>
<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Crear Usuario</h1>
                <small class="text-secondary">Registra un nuevo usuario</small>
            </div>
            <div class="card-body p-4">
    <form action="/usuarios" method="POST" class="row g-3">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre:</label>
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre del usuario" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="correo">Correo:</label>
            <input class="form-control" type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="password">Password:</label>
            <input class="form-control" type="password" id="password" name="password" placeholder="Contraseña" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="cargo">Cargo:</label>
            <input class="form-control" type="text" id="cargo" name="cargo" placeholder="Cargo del usuario" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="activo">Activo:</label>
            <select class="form-select" id="activo" name="activo">
                <option value="1"> Activo </option>
                <option value="0"> Inactivo </option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="rol_id">ID de Rol:</label>
            <input class="form-control" type="number" id="rol_id" name="rol_id" placeholder="ID del rol" required>
        </div>
        <div class="col-12 d-grid pt-2">
            <button type="submit" class="btn btn-primary btn-lg">Agregar Usuario</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
