<?php
session_start();
include 'config.php';

// Verifica si el usuario tiene el rol de admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Consulta para obtener todos los usuarios que sean vendedores
$sql = "SELECT ID_USUARIO, USUARIO, NOMBRE, FECHA_CREACION FROM usuarios WHERE ROL = 'vendedor'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vendedores</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgrounds/Fondo2.png'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del navegador */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Fija el fondo para que no se mueva al hacer scroll */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .table-container {
            background-color: rgba(255, 255, 255, 0.418);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .inicio {
            padding: 10px 20px;
            border: none;
            background-color: grey;
            color: #000000;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transform: translateY(-30%); /* Mueve el elemento hacia arriba */
        }
        .inicio:hover {
            background-color: #dddddd;
        }
    </style>
</head>
<body>

<div class="table-container">
    <h2>Lista de Vendedores</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Fecha creada</th>
        </tr>

        <?php
        // Verifica si hay resultados
        if ($result->num_rows > 0) {
            // Itera sobre los resultados y crea filas en la tabla
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ID_USUARIO'] . "</td>";
                echo "<td>" . $row['USUARIO'] . "</td>";
                echo "<td>" . $row['NOMBRE'] . "</td>";
                echo "<td>" . $row['FECHA_CREACION'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No se encontraron vendedores.</td></tr>";
        }
        $conn->close();
        ?>
        <a href="index1.php" class="inicio">inicio</a>
    </table>
</div>

</body>
</html>