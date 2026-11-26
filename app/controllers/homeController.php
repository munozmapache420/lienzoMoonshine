<?php

class homeController {

    public $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function index() {
        $productos = $this->producto->getAll();
        require_once __DIR__ . '/../views/productos/home.php';
    }
}