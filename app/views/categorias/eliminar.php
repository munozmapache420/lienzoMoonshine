<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

?>
<form action="/categorias/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este producto?')">
    <input type="hidden" name="id" value="<?=$categorias['id']?>">
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
