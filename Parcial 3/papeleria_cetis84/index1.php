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
    <title>Papelería Cetis84</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
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