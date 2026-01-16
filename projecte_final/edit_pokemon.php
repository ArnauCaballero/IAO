<?php
require_once 'header.php'; // Includes DB/Session

if (!isset($_GET['id'])) {
    header("Location: my_pokemon.php");
    exit;
}

$capture_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Verify ownership
$stmt = $pdo->prepare("
    SELECT c.id, c.nickname, p.name 
    FROM captures c 
    JOIN pokemon p ON c.pokemon_id = p.id
    WHERE c.id = ? AND c.user_id = ?
");
$stmt->execute([$capture_id, $user_id]);
$capture = $stmt->fetch();

if (!$capture) {
    die("No tens permís per editar aquest Pokémon.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_nickname = trim($_POST['nickname']);

    // If empty, set to NULL (will use default name logic in display)
    if ($new_nickname === '') {
        $update_sql = "UPDATE captures SET nickname = NULL WHERE id = ?";
        $stmt = $pdo->prepare($update_sql);
        $stmt->execute([$capture_id]);
    } else {
        $update_sql = "UPDATE captures SET nickname = ? WHERE id = ?";
        $stmt = $pdo->prepare($update_sql);
        $stmt->execute([$new_nickname, $capture_id]);
    }

    header("Location: my_pokemon.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Editar Apodo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Editar Apodo per a
            <?php echo ucfirst($capture['name']); ?>
        </h2>

        <form method="POST" style="max-width: 400px;">
            <div class="form-group">
                <label for="nickname">Nou Apodo:</label>
                <input type="text" id="nickname" name="nickname"
                    value="<?php echo htmlspecialchars($capture['nickname'] ?? ''); ?>"
                    placeholder="Deixar buit per nom original">
                <small>Si el deixes buit, es farà servir el nom original (
                    <?php echo ucfirst($capture['name']); ?>).
                </small>
            </div>

            <button type="submit" class="btn">Guardar</button>
            <a href="my_pokemon.php" class="btn" style="background-color: #777;">Cancel·lar</a>
        </form>
    </div>
</body>

</html>