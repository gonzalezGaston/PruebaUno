<?php
session_start();


function filtrarProducto($productos, $valor, $nombre, $cant, $modelo, $valorM) {
    $result = '';
    foreach ($productos as $producto) {
        if ($producto["valor"] <= $valorM){
        $result .= "Nombre: " . $producto['nombre'] . ", valor: " . $producto['valor'] . ", modelo: " . $producto["modelo"] . ", cantidad: " .$producto["cant"] ."<br>";
        return $result;
        }
    }
    if ($result === ""){
        return "No existen productos con un valor o igual al ingresado.<br>";
    }
    return $result;
}

// Redirigir de vuelta a index.php
header("Location: formulario.php"); 
exit();
?>