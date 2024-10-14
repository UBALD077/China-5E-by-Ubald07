<?php
session_start();
include 'db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Obtener el personaje del usuario
$query = $pdo->prepare("SELECT * FROM characters WHERE user_id = :user_id");
$query->execute(['user_id' => $user_id]);
$character = $query->fetch();

// Mostrar interfaz de gestión del personaje
if ($character) {
    // Obtener los torneos disponibles
    $tournamentsQuery = $pdo->query("SELECT * FROM tournaments WHERE winner_id IS NULL");
    $tournaments = $tournamentsQuery->fetchAll();

    // Inscribir al personaje en un torneo
    if (isset($_POST['join_tournament'])) {
        $tournament_id = $_POST['tournament_id'];
        
        // Verificar si el personaje ya está inscrito
        $checkQuery = $pdo->prepare("SELECT * FROM tournament_participants WHERE tournament_id = :tournament_id AND character_id = :character_id");
        $checkQuery->execute(['tournament_id' => $tournament_id, 'character_id' => $character['id']]);
        if ($checkQuery->rowCount() == 0) {
            // Inscribir al personaje
            $joinQuery = $pdo->prepare("
                INSERT INTO tournament_participants (tournament_id, character_id) 
                VALUES (:tournament_id, :character_id)
            ");
            $joinQuery->execute(['tournament_id' => $tournament_id, 'character_id' => $character['id']]);
            $message = "Te has inscrito en el torneo.";
        } else {
            $message = "Ya estás inscrito en este torneo.";
        }
    }

    // Simular torneo (solo el administrador puede decidir cuándo se realiza esta acción)
    if (isset($_POST['simulate_tournament'])) {
        $tournament_id = $_POST['tournament_id'];

        // Obtener los participantes del torneo
        $participantsQuery = $pdo->prepare("
            SELECT * FROM tournament_participants WHERE tournament_id = :tournament_id
        ");
        $participantsQuery->execute(['tournament_id' => $tournament_id]);
        $participants = $participantsQuery->fetchAll();

        if (count($participants) > 1) {
            // Seleccionar ganador aleatorio
            $winner = $participants[array_rand($participants)];

            // Actualizar el torneo con el ganador
            $updateQuery = $pdo->prepare("
                UPDATE tournaments SET winner_id = :winner_id WHERE id = :tournament_id
            ");
            $updateQuery->execute(['winner_id' => $winner['character_id'], 'tournament_id' => $tournament_id]);
            $message = "El torneo ha finalizado. Ganador: " . $winner['character_id'];
        } else {
            $message = "No hay suficientes participantes para el torneo.";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>Dashboard - Torneos</title>
    </head>
    <body>
        <div class="dashboard-container">
            <h1>Participar en Torneos</h1>

            <!-- Mostrar torneos disponibles -->
            <h2>Torneos disponibles</h2>
            <?php if (isset($message)) echo "<p>$message</p>"; ?>
            <?php if (count($tournaments) > 0): ?>
                <form method="POST">
                    <label for="tournament_id">Selecciona un torneo:</label>
                    <select name="tournament_id" id="tournament_id">
                        <?php foreach ($tournaments as $tournament): ?>
                            <option value="<?php echo $tournament['id']; ?>"><?php echo $tournament['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="join_tournament">Unirse al Torneo</button>
                </form>
                <!-- Botón para regresar al dashboard principal -->
                    <form action="dashboard.php" method="get">
                        <button type="submit">Regresar</button>
                    </form>
            <?php else: ?>
                <p>No hay torneos disponibles.</p>
            <?php endif; ?>

        </div>
    </body>
    </html>

    <?php
}
?>
