<?php
require_once 'header.php';

// Access Control
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: gacha.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: admin_users.php");
    exit;
}

$target_user_id = $_GET['id'];

// Fetch User Details
$stmt = $pdo->prepare("SELECT * FROM usuaris WHERE id = ?");
$stmt->execute([$target_user_id]);
$target_user = $stmt->fetch();

if (!$target_user) {
    die("Usuari no trobat.");
}

// Fetch ALL Pokemon (Including those not in team)
$stmt = $pdo->prepare("
    SELECT c.id as capture_id, c.nickname, c.is_on_team, p.name, p.sprite, p.type1, p.type2 
    FROM captures c 
    JOIN pokemon p ON c.pokemon_id = p.id 
    WHERE c.user_id = ?
    ORDER BY c.is_on_team DESC, c.captured_at DESC
");
$stmt->execute([$target_user_id]);
$captures = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Pokemons de
        <?php echo htmlspecialchars($target_user['username']); ?>
    </title>
    <link rel="stylesheet" href="style.css">
    <style>
        .is-team-badge {
            background-color: gold;
            color: black;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Col·lecció de:
                <?php echo htmlspecialchars($target_user['username']); ?>
            </h2>
            <a href="admin_users.php" class="btn" style="background-color: #666;">Tornar</a>
        </div>

        <p>Total Capturats:
            <?php echo count($captures); ?>
        </p>

        <div class="card-grid">
            <?php foreach ($captures as $p): ?>
                <div class="pokemon-card">
                    <?php if ($p['is_on_team']): ?>
                        <span class="is-team-badge">A l'equip</span>
                    <?php endif; ?>
                    <img src="<?php echo $p['sprite']; ?>" alt="<?php echo $p['name']; ?>" class="pokemon-img">
                    <h3>
                        <?php echo $p['nickname'] ? htmlspecialchars($p['nickname']) : ucfirst($p['name']); ?>
                    </h3>
                    <p style="color: #666; font-size: 0.9em;">
                        <?php echo ucfirst($p['name']); ?>
                    </p>
                    <div>
                        <span class="type-badge type-<?php echo $p['type1']; ?>">
                            <?php echo $p['type1']; ?>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($captures)): ?>
            <p>Aquest usuari no té cap Pokémon.</p>
        <?php endif; ?>
    </div>
</body>

</html>