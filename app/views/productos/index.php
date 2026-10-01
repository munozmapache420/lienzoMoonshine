<!-- MENÚ -->

<nav>

    <a href="../../../public/index.php">
        Usuarios
    </a>

    <a href="index.php">
        <strong>Productos</strong>
    </a>

    <a href="../categorias/index.php">
        Categorías
    </a>

    <a href="../clientes/index.php">
        Clientes
    </a>

    <a href="../ventas/index.php">
        Ventas
    </a>

</nav>


<h1>Gestión de Productos</h1>


<h2>Productos Registrados</h2>


<?php if (!empty($productos)): ?>

    <p>
        Total de productos:
        <strong><?= count($productos) ?></strong>
    </p>


    <div class="users-table">

        <table border="1">

            <thead>

                <tr>

                    <th>ID</th>

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

                        <td>
                            <?= ($p['id']) ?>
                        </td>


                        <td>
                            <?= ($p['nombre']) ?>
                        </td>


                        <td>
                            <?= ($p['descripcion'] ?? '') ?>
                        </td>


                        <td>
                            <?= ($p['categoria_id']) ?>
                        </td>


                        <td>
                            <?= ($p['id_inventario'] ?? '') ?>
                        </td>


                        <td>
                            $<?= number_format(
                                (float)$p['precio_compra'],
                                2,
                                ',',
                                '.'
                            ) ?>
                        </td>


                        <td>
                            $<?= number_format(
                                (float)$p['precio_venta'],
                                2,
                                ',',
                                '.'
                            ) ?>
                        </td>


                        <td>
                            <?=($p['stock']) ?>
                        </td>


                        <td>
                            <?= ($p['stock_minimo']) ?>
                        </td>


                        <td>
                            <?= ($p['estado']) ?>
                        </td>


                        <td>

                            <a
                                href="editar.php?id=<?= urlencode($p['id']) ?>"
                                class="users-table--edit"
                            >
                                Editar
                            </a>


                            <a
                                href="eliminar.php?id=<?= urlencode($p['id']) ?>"
                                class="users-table--delete"
                                onclick="return confirm('¿Seguro que deseas eliminar este producto?')"
                            >
                                Eliminar
                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>


<?php else: ?>

    <p>
        No hay productos registrados.
    </p>

<?php endif; ?>
