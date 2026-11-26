
<?php

$rutas = [
    "GET" => [

        "/productos"        => ['productoController', 'index'],
        "/productos/crear"  => ['productoController', 'crear'],
        "/productos/editar" => ['productoController', 'editar'],
        "/api/productos" => ['productoController', 'listarJSON'],
        "/" => ['homeController', 'index'],
        
        "/usuarios"        => ['UsuarioController', 'index'],
        "/usuarios/crear"  => ['UsuarioController', 'crear'],
        "/usuarios/editar" => ['UsuarioController', 'editar'],
        
        "/categorias"        => ['categoriaController', 'index'],
        "/categorias/crear"  => ['categoriaController', 'crear'],
        "/categorias/editar" => ['categoriaController', 'editar'],

        "/clientes"        => ['clienteController', 'index'],
        "/clientes/crear"  => ['clienteController', 'crear'],
        "/clientes/editar" => ['clienteController', 'editar'],

        "/ventas"        => ['ventaController', 'index'],
        "/ventas/crear"  => ['ventaController', 'crear'],
        "/ventas/editar" => ['ventaController', 'editar'],
    ],

    "POST" => [
 
        "/productos/guardar"    => ['productoController', 'guardar'],
        "/productos/actualizar" => ['productoController', 'actualizar'],
        "/productos/eliminar"   => ['productoController', 'eliminar'],
        "/productos/imagen"     => ['productoController', 'subirImagen'],

        "/usuarios/guardar"    => ['UsuarioController', 'guardar'],
        "/usuarios/actualizar" => ['UsuarioController', 'actualizar'],
        "/usuarios/eliminar"   => ['UsuarioController', 'eliminar'],

     
        "/categorias/guardar"    => ['categoriaController', 'guardar'],
        "/categorias/actualizar" => ['categoriaController', 'actualizar'],
        "/categorias/eliminar"   => ['categoriaController', 'eliminar'],

        "/clientes/guardar"    => ['clienteController', 'guardar'],
        "/clientes/actualizar" => ['clienteController', 'actualizar'],
        "/clientes/eliminar"   => ['clienteController', 'eliminar'],

        
        "/ventas/guardar"    => ['ventaController', 'guardar'],
        "/ventas/actualizar" => ['ventaController', 'actualizar'],
        "/ventas/eliminar"   => ['ventaController', 'eliminar'],
    ]
];

return $rutas;
