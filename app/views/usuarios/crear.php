<?php
require_once __DIR__ . '/../../controllers/UsuarioController.php';

?>

<!-- FORMULARIO -->

<body>

    <div class="users-form">

        <form action="/usuarios" method="POST" style="text-align: center;">

            <h2>Crear Usuario</h2>

            <label for="nombre">Nombre:</label> <br>
            <input type="text" id="nombre" name="nombre" placeholder="Nombre del usuario" required style="background-color:#FFFDD0;"> <br>


            <label for="correo">Correo:</label><br>
            <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required style="background-color:#FFFDD0;"><br>


            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Contraseña" required style="background-color:#FFFDD0;"><br>


            <label for="cargo">Cargo:</label><br>
            <input type="text" id="cargo" name="cargo" placeholder="Cargo del usuario" required style="background-color:#FFFDD0;"><br>


            <label for="activo">Activo:</label><br>

            <select id="activo" name="activo">

                <option value="1"> Activo </option>
                <option value="0"> Inactivo </option>

            </select><br>


            <label for="rol_id">ID de Rol:</label><br>
            <input type="number" id="rol_id" name="rol_id" placeholder="ID del rol" required style="background-color:#FFFDD0;"><br>


            <br>

            <button type="submit" value="Agregar Usuario" style="background-color:#F0F8FF">
                Agregar Usuario
            </button>

        </form>

    </div>

</body>
