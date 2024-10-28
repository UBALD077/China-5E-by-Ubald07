<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

include 'db.php';

$user_id = $_SESSION['user_id'];

$query = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$query->execute(['user_id' => $user_id]);
$user = $query->fetch();

if (!$user) {
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
    <title>Dashboard - Cuenta</title>
</head>
<body>
    <div class="dashboard-main">
        <h1>Bienvenido, <?php echo htmlspecialchars($user['name']); ?>!</h1>
        <div class="user-info">
            <p><strong>Correo Electrónico:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Avatar:</strong></p>
            <img src="avatars/<?php echo htmlspecialchars($user['avatar']); ?>" alt="Avatar" width="100">
        </div>
        <div class="buttons-container">

            <!-- Botón para regresar a la página principal del dashboard -->
            <form action="dashboard.php" method="get">
                <button type="submit">Regresar</button>
            </form>

            <!-- Botón para cerrar sesión -->
            <form action="logout.php" method="post">
                <button type="submit">Cerrar Sesión</button>
            </form>
        </div>
    </div>
</body>
</html>
