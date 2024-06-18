<?php
session_start();

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);
    $cantidad = intval($_POST['cantidad']);

    $producto = [
        'nombre' => $nombre,
        'precio' => $precio,
        'cantidad' => $cantidad
    ];

    array_push($_SESSION['productos'], $producto);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos del Minimarket</title>
    <link href="./css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-green-400 to-blue-500 min-h-screen flex items-center justify-center p-6">
    <div class="container mx-auto max-w-2xl bg-green-400 p-8 rounded-lg shadow-lg">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Agregar Producto</h1>
        <form id="productForm" action="" method="POST" class="space-y-4">
            <div>
                <label for="nombre" class="block text-lg font-semibold text-gray-700">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" class="mt-2 w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <span class="text-red-500 text-sm" id="error-nombre"></span>
            </div>
            <div>
                <label for="precio" class="block text-lg font-semibold text-gray-700">Precio por Unidad:</label>
                <input type="text" id="precio" name="precio" class="mt-2 w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <span class="text-red-500 text-sm" id="error-precio"></span>
            </div>
            <div>
                <label for="cantidad" class="block text-lg font-semibold text-gray-700">Cantidad en Inventario:</label>
                <input type="text" id="cantidad" name="cantidad" class="mt-2 w-full p-3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <span class="text-red-500 text-sm" id="error-cantidad"></span>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-gray-700 py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300">Guardar Producto</button>
        </form>

        <h2 class="text-2xl font-bold mt-10 mb-6 text-center text-gray-800">Lista de Productos</h2>
        <div class="bg-gray-50 p-6 rounded-lg shadow-lg">
            <?php if (isset($_SESSION['productos']) && count($_SESSION['productos']) > 0): ?>
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-3 px-4">Nombre del Producto</th>
                            <th class="py-3 px-4">Precio por Unidad</th>
                            <th class="py-3 px-4">Cantidad en Inventario</th>
                            <th class="py-3 px-4">Valor Total</th>
                            <th class="py-3 px-4">Estado en Stock</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php foreach ($_SESSION['productos'] as $producto): ?>
                            <?php
                            $valorTotal = $producto['precio'] * $producto['cantidad'];
                            $estado = $producto['cantidad'] > 0 ? 'En stock' : 'Agotado';
                            ?>
                            <tr class="border-b">
                                <td class="py-3 px-4"><?= htmlspecialchars($producto['nombre']) ?></td>
                                <td class="py-3 px-4"><?= number_format($producto['precio'], 2) ?></td>
                                <td class="py-3 px-4"><?= $producto['cantidad'] ?></td>
                                <td class="py-3 px-4"><?= number_format($valorTotal, 2) ?></td>
                                <td class="py-3 px-4"><?= $estado ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center text-gray-700">No hay productos registrados.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="validacion.js"></script>
</body>
</html>
