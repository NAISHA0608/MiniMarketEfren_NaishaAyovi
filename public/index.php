<?php
// Función para calcular el precio total basado en el precio unitario y la cantidad
function calcularPrecio($precio, $cantidad) {
    return $precio * $cantidad;
}

// Función para agregar un producto a un arreglo o lista y calcular su valor total
function agregarProducto($nombre, $precio, $cantidad) {
    $valorTotal = calcularPrecio($precio, $cantidad);

    // Devuelve un array con la información del producto
    return array(
        'Nombre' => htmlspecialchars($nombre),
        'Precio' => number_format($precio, 2),
        'Cantidad' => $cantidad,
        'ValorTotal' => number_format($valorTotal, 2),
        'Estado' => $cantidad > 0 ? 'En stock' : 'Agotado'
    );
}

// Función para mostrar la información general del producto
function mostrarInformacionGeneral($producto) {
    echo '<div class="mt-8">';
    echo '<h3 class="text-2xl mb-4 text-center text-gray-800 font-bold">Información del Producto</h3>';
    echo '<table class="min-w-full bg-white rounded-lg overflow-hidden">';
    echo '<thead>';
    echo '<tr class="bg-gray-200 text-gray-700">';
    echo '<th class="py-2 px-4">Característica</th>';
    echo '<th class="py-2 px-4">Valor</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    foreach ($producto as $caracteristica => $valor) {
        echo '<tr>';
        echo '<td class="py-2 px-4">' . $caracteristica . '</td>';
        echo '<td class="py-2 px-4">' . $valor . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}

// Manejo del formulario POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $cantidad = $_POST['cantidad'] ?? '';

    // Validar datos de entrada
    if (empty($nombre) || !is_numeric($precio) || !is_numeric($cantidad)) {
        echo 'Por favor, rellene todos los campos correctamente.';
    } else {
        $producto = agregarProducto($nombre, floatval($precio), intval($cantidad));
        $_SESSION['productos'][] = $producto;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calcular Precio de Electrodoméstico</title>
    <link href="./css/tailwind.css" rel="stylesheet">
    <link href="./styles.css" rel="stylesheet"> <!-- Incluyendo estilo adicional para ajustar la interfaz de usuario -->
</head>
<body class="bg-gradient-to-r from-pink-400 via-pink-500 to-red-500 flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md p-8 flex flex-wrap md:flex-nowrap">
            <div class="w-full md:w-1/2 p-4">
                <h2 class="text-4xl mb-6 text-center text-gray-800 font-bold">Calcular Precio de Electrodoméstico</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="space-y-4" id="miFormulario">
                    <div>
                        <label for="name" class="block text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label for="precio" class="block text-gray-700">Precio</label>
                        <input type="text" id="precio" name="precio" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                    </div>
                    <div>
                        <label for="cantidad" class="block text-gray-700">Cantidad</label>
                        <input type="text" id="cantidad" name="cantidad" class="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent" required>
                    </div>
                    <button type="submit" class="w-full bg-pink-500 text-white p-2 rounded-lg hover:bg-pink-600 transition duration-300">Ingresar</button>
                </form>
            </div>

            <?php if (isset($producto)) { ?>
            <div class="w-full md:w-1/2 p-4">
                <?php mostrarInformacionGeneral($producto); ?>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
<script src="scripts.js"></script>
</html>
