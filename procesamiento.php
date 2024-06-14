<?php
session_start();

// Definir las funciones
function agregarProducto($producto, $nombre, $cant, $modelo, $valor) {
    $producto[] = [
        'nombre' => $nombre,
        'cant' => $cant,
        'modelo' => $modelo,
        "valor" => $valor
    ];
    return $producto;
}

function buscarProducto($producto, $modelo) {
    foreach ($producto as $producto) {
        if ($producto['modelo'] == $modelo) {
            return "Nombre: " . $producto['nombre'] . ", Modelo: " . $producto["modelo"] . ", Valor: " . $producto["valor"] . "<br>";
        }
    }
    return "Producto no encontrado.<br>";
}

function mostrarProductos($producto) {
    $result = '';
    foreach ($producto as $producto) {
        $result .= "Nombre: " . $producto['nombre'] . ", valor: " . $producto['valor'] . ", modelo" . $producto["modelo"] . ", cantidad: " .$producto["cant"] ."<br>";
        
   
    }
    return $result;
}

function actualizarProducto($producto, $valor, $nombre, $cant) {
    foreach ($producto as &$producto) {
        if ($producto['modelo'] == $modelo) {
            $producto['nombre'] = $nombre;
            $producto["valor"] = $valor;
            $producto['cant'] = $cant;
            break;
        }
    }
    return $usuarios;
}

// Inicializar el array de usuarios en la sesión
if (!isset($_SESSION['producto'])) {
    $_SESSION['producto'] = []; 
}

$usuarios = $_SESSION['producto'];
$resultado = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];
    $nombre = $_POST['nombre'] ?? '';
    $cant = $_POST['cant'] ?? '';
    $valor = $_POST["valor"] ?? "";
    $modelo = $_POST['modelo'] ?? '';

    switch ($accion) {
        case 'agregar':
            $usuarios = agregarProducto($producto, $nombre, $cant, $modelo, $valor);
            $resultado = "producto agregado correctamente.<br>";
            break;
        
        case 'buscar':
            $resultado = buscarProducto($usuarios, $modelo);
            break;
        
        case 'mostrar':
            $resultado = mostrarProductos($producto);
            break;
        
        case 'actualizar':
            $usuarios = actualizarProducto($producto, $modelo, $nombre, $cant);
            $resultado = "Producto actualizado correctamente.<br>";
            break;

        case 'limpiar':
            $_SESSION['producto'] = [];
            $resultado = "Resultados limpiados correctamente.<br>";
            session_destroy();
            break;

        default:
            $resultado = "Acción no válida.";
    }

    $_SESSION['producto'] = $usuarios;
    $_SESSION['resultado'] = $resultado;
}

// Redirigir de vuelta a index.php
header("Location: formulario.php");
exit();
?>
