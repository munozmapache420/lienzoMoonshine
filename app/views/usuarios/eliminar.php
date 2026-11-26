<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

?>
<form action="/productos/eliminar" method="post" class="d-inline" onsubmit="return confirm('¿estas seguro de eliminar este producto?')">
    <input type="hidden" name="id" value="<?=$productos['id']?>">
    <button type="submit" class="btn btn-danger">Eliminar</button>
</form>
