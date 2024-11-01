<?php
// index.php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Papelería CETis 84</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Estilos internos para personalizar el diseño */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #2C3E50, #4CA1AF);
            color: white;
            background-image: url('backgrounds/Fondo4.png'); /* Ruta de la imagen */
            background-size: cover; /* Ajusta la imagen al tamaño del navegador */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Fija el fondo para que no se mueva al hacer scroll */
        }
        
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 500px;
            transform: translateY(0%); /* Mueve el elemento hacia arriba */
            transform: translateX(3%); /* Mueve el elemento hacia arriba */
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            color: #FFFFFF;
            background-color: #3498DB;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-weight: bold;
        }

        .button:hover {
            background-color: #2980B9;
        }

        .button-logout {
            background-color: #E74C3C;
        }

        .button-logout:hover {
            background-color: #C0392B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
        
        <?php if ($_SESSION['rol'] == 'admin') { ?>
            <a href="usuarios.php" class="button">Gestión de Usuarios</a><br>
        <?php } ?>
        <?php if ($_SESSION['rol'] == 'vendedor') { ?>
            <a href="ventas.php" class="button">Ventas</a><br>
        <?php } ?>
        
        <a href="productos.php" class="button">Gestión de Productos</a><br>
        <a href="login.php" class="button button-logout">Cerrar Sesión</a>
    </div>
</body>
</html>
