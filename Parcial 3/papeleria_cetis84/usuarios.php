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
    <link rel="stylesheet" href="css/usuario.css">
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
        <a href="index1.php" class="inicio">Regresar</a>
    </table>
</div>

</body>
</html>