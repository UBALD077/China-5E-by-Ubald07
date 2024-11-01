<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_producto'])) {
    $nombre_producto = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    $sql = "INSERT INTO productos (NOMBRE_PRODUCTO, DESCRIPCION, PRECIO) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", $nombre_producto, $descripcion, $precio);

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
    <title>Gestión de Productos</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-size: cover;
            background-position: center;
            background-image: url('backgrounds/Fondo3.png'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del navegador */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Fija el fondo para que no se mueva al hacer scroll */
        }

        .container {
            width: 400px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            text-transform: uppercase;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .links {
            margin-top: 20px;
        }

        .btn-link {
            display: inline-block;
            padding: 8px;
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            transition: color 0.3s;
        }

        .btn-link:hover {
            color: #388e3c;
        }
    </style>
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
            <div class="links">
                <a href="index1.php" class="btn-link">Inicio</a>
                <a href="ventas.php" class="btn-link">Ventas</a>
            </div>
        </form>
    </div>
</body>
</html>
