<div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-7 col-xl-6">
        <div class="card border-secondary shadow-lg">
            <div class="card-header py-3">
                <h1 class="h4 mb-0 text-primary">Editar Usuario</h1>
                <small class="text-secondary">Actualiza los datos del usuario</small>
            </div>
            <div class="card-body p-4">
    <form action="/usuarios/actualizar" method="POST" class="row g-3">
        <input type="hidden" name="id" value="<?= $usuario->id ?>">
        <div class="col-12">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" id="nombre" name="nombre" value="<?=  $usuario->nombre ?>" required>
        </div>
        <div class="col-12">
            <label class="form-label" for="correo">Correo</label>
            <input class="form-control" type="email" id="correo" name="correo" value="<?= $usuario->correo ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" type="password" id="password" name="password" value="<?=  $usuario->password ?>" required>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="cargo">Cargo</label>
            <input class="form-control" type="text" id="cargo" name="cargo" value="<?= $usuario->cargo ?>">
        </div>
        <div class="col-md-6">
            <label class="form-label" for="activo">Activo</label>
            <select class="form-select" id="activo" name="activo">
                <option value="1"<?= $usuario->activo == 1 ? ' selected' : '' ?>> Activo </option>
                <option value="0"<?= $usuario->activo == 0 ? ' selected' : '' ?>> Inactivo </option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="rol_id">ID de Rol</label>
            <input class="form-control" type="number" id="rol_id" name="rol_id" value="<?=  $usuario->rol_id ?>" required>
        </div>
        <div class="col-12 d-flex flex-wrap gap-2 justify-content-end pt-2">
            <a href="/usuarios" class="btn btn-outline-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>
            </div>
        </div>
    </div>
</div>
