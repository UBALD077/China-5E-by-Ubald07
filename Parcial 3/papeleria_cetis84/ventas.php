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
    <link rel="stylesheet" href="css/ventas.css">
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
                <a href="index1.php" class="btn-link">Regresar</a>
            </div>
        </form>
    </div>
</body>
</html>
