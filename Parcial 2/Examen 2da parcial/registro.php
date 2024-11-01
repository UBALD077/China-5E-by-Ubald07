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
        echo "Registro exitoso. Ahora puedes iniciar sesión.";
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backgrounds/Fondo1.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            width: 300px;
            height: 420px;
            text-align: center;
            transform: translateY(-10%); /* Mueve el elemento hacia arriba */
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 90%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-bottom: 2px solid #000;
            background: transparent;
            color: #000;
            font-size: 16px;
            outline: none;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #333;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 15px;
            transition: background-color 0.3s ease;
            /*transform: translateY(150%); /* Mueve el elemento hacia arriba */
        }
        button:hover {
            background-color: #555;
        }
        .inicio {
            padding: 10px 20px;
            border: none;
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transform: translateY(150%); /* Mueve el elemento hacia arriba */
        }
        .inicio:hover {
            background-color: #dddddd;
        }
    </style>
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
