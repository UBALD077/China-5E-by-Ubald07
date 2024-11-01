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
    <style>
        body{
            font-family: Arial, sans-serif;
            /*background-color: #f4f4f4;*/ /* Comentado en caso de usar la imagen de fondo */
            background-image: url('backgrounds/Fondo1.png'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del navegador */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Fija el fondo para que no se mueva al hacer scroll */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Asegura que el contenido ocupe todo el alto de la ventana */
            margin: 0; /* Elimina los márgenes del cuerpo */  
        } 
        .container{
            background-color: rgba(255, 255, 255, 0.418);
            padding: 20px;
            border-radius: 2px;
            box-shadow: 0 20px 100px rgb(0, 0, 0);
            width: 22%;
            height: 37%;
            transform: translateY(-28%); /* Mueve el elemento hacia arriba */
            text-align: center;
            position: relative; /* O absolute si lo necesitas */
        }  
        input[type="text"],
        input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-bottom: 2px solid #ffffff;
            background: transparent;
            color: #ffffff;
            font-size: 16px;
            outline: none;
        }
        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: transparent; /* Oculta el placeholder */
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #ffffff;
            color: #000000;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #dddddd;
        }
        /* Estilo para el botón de registro */
        .registro-btn {
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
        .registro-btn:hover {
            background-color: #dddddd;
        }

    </style>
</head>
<body>
    <div class="container">
        <form method="POST" action="">
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
