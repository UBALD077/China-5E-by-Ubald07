<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_producto'])) {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos (NOMBRE_PRODUCTO, DESCRIPCION, PRECIO) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $nombre_producto, $descripcion, $precio);

    if ($stmt->execute()) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gestión de los Productos</title>
    <link rel="stylesheet" href="css/productos.css">
</head>
<body>
    <div class="container">
        <h1>Gestión de Productos</h1>
        <form method="POST" action="">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre_producto" required><br>
            
            <label>Descripción:</label>
            <textarea name="descripcion"></textarea><br>
            
            <label>Precio:</label>
            <input type="number" step="0.01" name="precio" required><br>

            <button type="submit" name="agregar_producto" class="btn">Agregar Producto</button>
            <button type="button" onclick="window.location.href='generar_pdf.php'" class="btn">Ver en PDF</button>
            <button type="button" onclick="window.location.href='Descargar.php'" class="btn">Descargar pdf</button>
            <div class="links">
                <a href="index1.php" class="btn-link">Inicio</a>
                <a href="ventas.php" class="btn-link">Ventas</a>
            </div>
        </form>
    </div>
</body>
</html>