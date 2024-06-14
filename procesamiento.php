<?php
session_start();

// Definir las funciones
function agregarProducto($productos, $nombre, $cant, $modelo, $valor) {
    $productos[] = [
        'nombre' => $nombre,
        'cant' => $cant,
        'modelo' => $modelo,
        "valor" => $valor
    ];
    return $productos;
}

function buscarProducto($productos, $modelo) {
    foreach ($productos as $producto) {
        if ($producto['modelo'] == $modelo) {
            return "Nombre: " . $producto['nombre'] . ", Modelo: " . $producto["modelo"] . ", Valor: " . $producto["valor"] . "<br>";
        }
    }
    return "Producto no encontrado.<br>";
}

function mostrarProductos($productos) {
    $result = '';
    foreach ($productos as $producto) {
        $result .= "Nombre: " . $producto['nombre'] . ", valor: " . $producto['valor'] . ", modelo: " . $producto["modelo"] . ", cantidad: " .$producto["cant"] ."<br>";
        
   
    }
    return $result;
}

function actualizarProducto($productos, $valor, $nombre, $cant, $modelo) {
    foreach ($productos as &$producto) {
        if ($producto['modelo'] == $modelo) {
            $producto['nombre'] = $nombre;
            $producto["valor"] = $valor;
            $producto['cant'] = $cant;
            break;
        }
    }
    return $productos;
}

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

// Inicializar el array de usuarios en la sesión
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = []; 
}

$productos = $_SESSION['productos'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $cant = $_POST['cant'] ?? '';
    $valor = $_POST["valor"] ?? "";
    $modelo = $_POST['modelo'] ?? '';
    $modelo = $_POST['valorM'] ?? '';

    switch ($accion) {
        case 'agregar':
            $productos = agregarProducto($productos, $nombre, $cant, $modelo, $valor);
            $resultado = "producto agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarProducto($productos, $modelo);
            break;
        
        case 'mostrar':
            $resultado = mostrarProductos($productos);
            break;
        
        case 'actualizar':
            $productos = actualizarProducto($productos, $modelo, $nombre, $cant, $modelo);
            $resultado = "Producto actualizado correctamente.<br>";
            break;

        case 'limpiar':
            $_SESSION['productos'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['productos'] = $productos;
    $_SESSION['resultado'] = $resultado;
}

// Redirigir de vuelta a index.php
header("Location: formulario.php"); 
exit();
?>
