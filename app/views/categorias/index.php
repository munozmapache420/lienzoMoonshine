<!-- MENÚ -->

<nav>

    <a href="../../../public/index.php">
        Usuarios
    </a>

    <a href="../productos/index.php">
        Productos
    </a>

    <a href="index.php">
        <strong>Categorías</strong>
    </a>

    <a href="../clientes/index.php">
        Clientes
    </a>

    <a href="../ventas/index.php">
        Ventas
    </a>

</nav>


<h1>Gestión de Categorías</h1>


<h2>Categorías Registradas</h2>


<?php if (!empty($categorias)): ?>

    <p>
        Total de categorías:
        <strong><?= count($categorias) ?></strong>
    </p>


    <div class="users-table">

        <table border="1">

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Nombre</th>

                    <th>Descripción</th>

                    <th>Precio</th>

                    <th>Acciones</th>

                </tr>

            </thead>


            <tbody>

                <?php foreach ($categorias as $c): ?>

                    <tr>

                        <td>
                            <?= ($c['id']) ?>
                        </td>


                        <td>
                            <?= ($c['nombre']) ?>
                        </td>


                        <td>
                            <?= ($c['descripcion']) ?>
                        </td>


                        <td>
                            $<?= number_format(
                                (float)$c['precio'],
                                2,
                                ',',
                                '.'
                            ) ?>
                        </td>


                        <td>

                            <a
                                href="editar.php?id=<?= urlencode($c['id']) ?>"
                                class="users-table--edit"
                            >
                                Editar
                            </a>


                            <a
                                href="eliminar.php?id=<?= urlencode($c['id']) ?>"
                                class="users-table--delete"
                                onclick="return confirm('¿Seguro que deseas eliminar esta categoría?')"
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
        No hay categorías registradas.
    </p>

<?php endif; ?>
