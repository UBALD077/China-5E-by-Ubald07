<?php
// registro.php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol']; // Capturamos el rol seleccionado

    // Preparamos la consulta SQL
    $sql = "INSERT INTO usuarios (NOMBRE, USUARIO, CONTRASENA, ROL) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nombre, $usuario, $contrasena, $rol);

    // Ejecutamos la consulta y verificamos si fue exitosa
    if ($stmt->execute()) {
        echo "Te registraste bien. Ahora ya puedes iniciar sesión.";
    } else {
        echo "Error al registrar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="POST" action="">
            <label>Nombre:</label>
            <input type="text" name="nombre" required><br>

            <label>Usuario:</label>
            <input type="text" name="usuario" required><br>

            <label>Contraseña:</label>
            <input type="password" name="contrasena" required><br>

            <label>Rol:</label>
            <select name="rol" required>
                <option value="admin">Admin</option>
                <option value="vendedor">Vendedor</option>
            </select><br><br>

            <button type="submit">Registrarse</button><br>
            <a href="login.php" class="inicio">inicia sesion</a>
        </form>
    </div>
</body>
</html>
