<?php
session_start();
include 'config.php';

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] != 'vendedor') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_venta'])) {
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $conn->begin_transaction();

    try {
        // Insertar la venta en la tabla ventas
        $sql_venta = "INSERT INTO ventas (ID_PRODUCTO, CANTIDAD, FECHA_VENTA) VALUES (?, ?, NOW())";
        $stmt_venta = $conn->prepare($sql_venta);
        $stmt_venta->bind_param("ii", $id_producto, $cantidad);
        $stmt_venta->execute();

        $conn->commit();
        echo "Venta registrada y stock actualizado.";
    } catch (Exception $e) {
        $conn->rollback();
        echo "Error al registrar la venta: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Ventas</title>
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
            background-image: url('backgrounds/Fondo5.png'); /* Ruta de la imagen */
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

        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
        <h1>Registro de Ventas</h1>
        <form method="POST" action="">
            <label>ID del Producto:</label>
            <input type="number" name="id_producto" required><br>
            
            <label>Cantidad:</label>
            <input type="number" name="cantidad" required><br>
            
            <button type="submit" name="registrar_venta" class="btn">Registrar Venta</button>
            
            <div class="links">
                <a href="index1.php" class="btn-link">Inicio</a>
            </div>
        </form>
    </div>
</body>
</html>
