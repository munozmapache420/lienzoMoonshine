<?php
require_once __DIR__ . '/../../controllers/ProductoController.php';

?>
<!-- FORMULARIO -->

<body>

    <div class="users-form">

        <form action="/productos" method="POST" style="text-align: center;">

            <h2>Crear Producto</h2>

            <label for="nombre">Nombre del Producto:</label> <br>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" required style="background-color:#FFFDD0;"> <br>
            
            <label for="descripcion"> Descripción:</label><br>
            <input type="text" id="descripcion" name="descripcion" placeholder="Descripción" style="background-color:#FFFDD0;"><br>

            <label for="categoria_id"> ID de Categoría: </label><br>
            <input type="number" id="categoria_id" name="categoria_id" placeholder="ID de categoría" required style="background-color:#FFFDD0;"><br>


            <label for="id_inventario"> ID de Inventario: </label><br>
            <input type="number" id="id_inventario" name="id_inventario" placeholder="ID del inventario" style="background-color:#FFFDD0;"><br>


            <label for="precio_compra">Precio de Compra: </label><br>
            <input type="number" step="0.01" id="precio_compra" name="precio_compra" placeholder="Ej: 15000" required style="background-color:#FFFDD0;"><br>


            <label for="precio_venta"> Precio de Venta: </label><br>
            <input type="number" step="0.01" id="precio_venta" name="precio_venta" placeholder="Ej: 25000" required style="background-color:#FFFDD0;"><br>


            <label for="stock"> Stock: </label><br>
            <input type="number" id="stock" name="stock" placeholder="Cantidad / Stock" required style="background-color:#FFFDD0;"><br>

            <label for="stock_minimo">Stock Mínimo: </label><br>
            <input type="number" id="stock_minimo" name="stock_minimo" value="0" required style="background-color:#FFFDD0;"><br>


            <label for="estado">Estado: </label><br>

            <select id="estado" name="estado" default="activo">

                <option value="activo"> Activo </option>
                <option value="inactivo"> Inactivo </option>
            </select><br>

<br>
            <button type="submit" value="Agregar Producto" style="background-color:#F0F8FF"> Agregar Producto</button>

        </form>

    </div>
</body>
