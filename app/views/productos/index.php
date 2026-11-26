<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <div>
        <h1 class="h2 mb-1 text-primary">Gestión de Productos</h1>
        <p class="text-secondary mb-0">Productos Registrados</p>
    </div>
        <a href="/productos/crear" class="btn btn-primary">＋ Nuevo producto</a>
</div>

<?php if (!empty($_SESSION['flash'])): ?>
    <div class="alert alert-<?= $_SESSION['flash']['tipo'] ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_SESSION['flash']['msg']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<?php if (!empty($productos)): ?>

    <div class="card border-secondary shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="fw-semibold">Productos Registrados</span>
            <span class="badge rounded-pill text-bg-primary">Total: <?= count($productos) ?></span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>imagen url</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>ID Categoría</th>
                        <th>ID Inventario</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Stock Mínimo</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $p): ?>
                        <tr>
                            <td><?= ($p['id']) ?></td>
                            <td style="min-width:130px">
                                <?php $colImg = $this->producto->columnaImagen(); $img = $colImg ? ($p[$colImg] ?? '') : ''; ?>
                                <img src="<?= $img ? htmlspecialchars($img) : 'data:image/gif;base64,R0lGODlhAQABAIAAAMLCwgAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==' ?>"
                                     alt="Imagen de <?= htmlspecialchars($p['nombre']) ?>"
                                     class="rounded border d-block mb-1 img-producto"
                                     style="width:64px;height:64px;object-fit:cover;background:#c2c2c2">
                                <form action="/productos/imagen" method="post" enctype="multipart/form-data" class="form-imagen">
                                    <input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                                    <label class="btn btn-sm btn-outline-secondary mb-0">
                                        <?= $img ? 'Cambiar imagen' : 'Subir imagen' ?>
                                        <input type="file" name="imagen" class="input-imagen" accept="image/jpeg,image/png,image/webp,image/gif" hidden>
                                    </label>
                                </form>
                            </td>
                            <td><span class="fw-semibold"><?= ($p['nombre']) ?></span></td>
                            <td><?= ($p['descripcion'] ?? '') ?></td>
                            <td><?= ($p['categoria_id']) ?></td>
                            <td><?= ($p['id_inventario'] ?? '') ?></td>
                            <td>$<?= number_format((float)$p['precio_compra'], 2, ',', '.') ?></td>
                            <td>$<?= number_format((float)$p['precio_venta'], 2, ',', '.') ?></td>
                            <td><?= ($p['stock']) ?></td>
                            <td><?= ($p['stock_minimo']) ?></td>
                            <td><span class="badge <?= $p['estado'] == 'activo' ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= $p['estado'] ?></span></td>
                            <td class="text-nowrap">
                                <a href="/productos/editar?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="/productos/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este registro?')">
                                    <input type="hidden" name="id" value="<?= $p['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<script>
document.querySelectorAll('.input-imagen').forEach(function (input) {
    input.addEventListener('change', function () {
        var archivo = input.files[0];
        if (!archivo) return;

        var tipos = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (tipos.indexOf(archivo.type) === -1) {
            alert('La imagen debe ser JPG, PNG, WEBP o GIF.');
            input.value = '';
            return;
        }
        if (archivo.size > 5 * 1024 * 1024) {
            alert('La imagen no puede superar 5 MB.');
            input.value = '';
            return;
        }

        var form = input.closest('form');
        var miniatura = form.parentElement.querySelector('.img-producto');
        miniatura.src = URL.createObjectURL(archivo);   // vista previa inmediata

        if (confirm('¿Guardar esta imagen para el producto?')) {
            form.submit();
        } else {
            input.value = '';
            location.reload();
        }
    });
});
</script>
<?php else: ?>

    <div class="alert alert-secondary text-center" role="alert">
        No hay productos registrados.
    </div>

<?php endif; ?>
