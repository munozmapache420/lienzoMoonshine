<?php 
echo "<h1 style=color:red;>JSON PRIMER EJERCICIO DE PHP A JSON</h1>". "</br>";

echo"prueba php json";

$producto = [ 
    [
    "id"=> 1,
    "nombre" => "cafe",
    "precio" => 35000,
    "stock" => 20,
    "disponibilidad"=> true
],
    [
    "id"=> 2,
    "nombre" => "leche",
    "precio" => 5000,
    "stock" => 20,
    "disponibilidad"=> true
],
    [
    "id"=> 3,
    "nombre" => "azucar",
    "precio" => 50000,
    "stock" => 20,
    "disponibilidad"=> true
]

];
$producto[] = [
    "id" => 4,
    "nombre" => "arroz",
    "precio" => 4000,
    "stock" => 30,
    "disponibilidad" => true
];
$json = json_encode($producto);
echo $json . "</br>";

///// parte 2
echo "<h1 style=color:red;>ejercicio 2 DE JSON A PHP </h1>". "</br>";

$json = file_get_contents(__DIR__ . "/productos.json",JSON_PRETTY_PRINT); 
$productos = json_decode($json, true); 
foreach ($productos as $producto){
 echo "id: " . $producto["id"] . "</br>";
 echo "nombre: " . $producto["nombre"] . "</br>"; 
 echo "precio: " . $producto["precio"] . "</br>";
 echo "stock: " . $producto["stock"] . "</br>";
 echo "disponible: " . $producto["disponible"] . "</br>";
 echo "categoria: " . $producto["categoria"] . "</br>";
}
"</br>";
echo "<h1 style=color:red;>registro de productos mayores a 100k</h1>". "</br>";

foreach( $productos as $producto) {
    if ($producto['precio']> 100000){
        echo "id: " . $producto["id"] . "</br>";
        echo "nombre: " . $producto["nombre"] . "</br>";
        echo "precio: " . $producto["precio"] . "</br>";
    }
}
echo "<h1 style=color:red;>modificar y convertir informacion</h1>". "</br>";

$productos = json_decode($json,true);
$idBuscar= 2;
foreach($productos as $indice=> $producto) {
    if($producto["id"] === $idBuscar) {
        $productos[$indice]["precio"]= 90000;
        echo "producto modificado correctamente . </br>";
}
}

$nuevoJson = json_encode($productos,JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

echo "<pre>";
echo $nuevoJson;
echo "<pre>";


echo "<h1 style=color:red;>actividad 2 </h1>". "</br>";
header("Content-Type: application/json; charset=utf-8");

$producto = [
    "id" => 1,
    "nombre" => "Mouse",
    "precio" => 35000
];

$idBuscado = 1;

if ($idBuscado === $producto["id"]) {


    http_response_code(200);
    echo json_encode($producto);

} else {

   
    http_response_code(404);
    echo json_encode([
        "mensaje" => "Producto no encontrado"
    ]);

}


echo "<h1 style=color:red;>actividad 3 </h1>". "</br>";
header("Content-Type: application/json; charset=utf-8");

$producto = [
    "id" => 3,
    "nombre" => "Monitor",
    "precio" => 780000,
    "stock" => 6
];

$idBuscado = 3;

if ($idBuscado === $producto["id"]) {


    http_response_code(200);

    echo json_encode($producto, JSON_PRETTY_PRINT);

} else {

    http_response_code(404);

    echo json_encode([
        "mensaje" => "El producto no existe"
    ], JSON_PRETTY_PRINT);

}

?>

