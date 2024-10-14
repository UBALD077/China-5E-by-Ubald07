<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Dashboard - Personajes</title>
</head>
<body>
    <div class="dashboard-main">
        <h1>Gestiona tus Personajes</h1>
        <div class="buttons-container">
            <!-- Botón para crear un nuevo personaje -->
            <form action="createCharacter.php" method="get">
                <button type="submit">Crear Personaje</button>
            </form>

            <!-- Botón para mostrar la lista de personajes -->
            <form action="listCharacters.php" method="get">
                <button type="submit">Lista de Personajes</button>
            </form>

            <!-- Botón para regresar a la página principal del dashboard -->
            <form action="dashboard.php" method="get">
                <button type="submit">Regresar</button>
            </form>
        </div>
    </div>
</body>
</html>
