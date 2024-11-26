<?php
// login.php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE USUARIO = '$usuario' AND CONTRASENA = '$contrasena'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['usuario'] = $row['USUARIO'];
        $_SESSION['rol'] = $row['ROL'];
        header("Location: index1.php");
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="">
        <h2>Hecho por Rangel Durán y Ubaldo Torres</h2>
            <label>Usuario:</label>
            <input type="text" name="usuario" required><br>
            <label><br>Contraseña:</label>
            <input type="password" name="contrasena" required><br><br>
            <button type="submit">Iniciar Sesión</button>
            
        </form>
        <a href="registro.php" class="registro-btn">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>
