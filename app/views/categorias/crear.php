<?php
require_once __DIR__ . '/../../controllers/CategoriaController.php';

?>
<body>

    <div class="users-form">

        <form action="/categorias" method="POST" style="text-align: center;">

            <h2>Crear Categoría</h2>

            <label for="nombre">Nombre de la Categoría:</label><br>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre de la categoría" required style="background-color:#FFFDD0;"><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" id="descripcion" name="descripcion" placeholder="Descripción" style="background-color:#FFFDD0;"><br>

            <label for="precio">Precio de Referencia:</label><br>
            <input type="number" step="0.01" id="precio" name="precio" placeholder="Precio de referencia" value="0" required style="background-color:#FFFDD0;"><br>

            <br>

            <button type="submit" style="background-color:#F0F8FF">
                Agregar Categoría
            </button>

        </form>

    </div>

</body>
