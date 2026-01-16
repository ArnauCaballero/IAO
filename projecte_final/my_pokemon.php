<?php
require_once 'header.php'; // Includes DB/Session

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];
$limit = ($role === 'vip' || $role === 'admin') ? 6 : 3;
$msg = '';

// Handle Form Submission (Update Team)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected = isset($_POST['team']) ? $_POST['team'] : [];
    
    if (count($selected) > $limit) {
        $msg = "Error: Com a $role només pots tenir $limit Pokémon al teu equip.";
    } else {
        // Reset current team
        $stmt = $pdo->prepare("UPDATE captures SET is_on_team = 0 WHERE user_id = ?");
        $stmt->execute([$user_id]);
        
        if (!empty($selected)) {
            // Set new team (secure IN clause)
            $placeholders = implode(',', array_fill(0, count($selected), '?'));
            $sql = "UPDATE captures SET is_on_team = 1 WHERE id IN ($placeholders) AND user_id = ?";
            $params = array_merge($selected, [$user_id]);
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
        $msg = "Equip actualitzat correctament!";
    }
}

// Fetch All Types for Filter Dropdown
$stmt_types = $pdo->query("SELECT DISTINCT type1 FROM pokemon UNION SELECT DISTINCT type2 FROM pokemon WHERE type2 IS NOT NULL ORDER BY type1");
$all_types = $stmt_types->fetchAll(PDO::FETCH_COLUMN);

// Handle Filter
$filter_type = $_GET['filter_type'] ?? '';

// Fetch User's Pokemon
$sql = "
    SELECT c.id as capture_id, c.nickname, c.is_on_team, p.name, p.sprite, p.type1, p.type2 
    FROM captures c 
    JOIN pokemon p ON c.pokemon_id = p.id 
    WHERE c.user_id = ?
";
$params = [$user_id];

if ($filter_type) {
    $sql .= " AND (p.type1 = ? OR p.type2 = ?)";
    $params[] = $filter_type;
    $params[] = $filter_type;
}

$sql .= " ORDER BY c.captured_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$captures = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Meu Equip</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .pokemon-checkbox {
            display: none;
        }
        .pokemon-label {
            display: block;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.2s;
        }
        .pokemon-checkbox:checked + .pokemon-label .pokemon-card {
            border: 2px solid var(--primary-color);
            background-color: #fff3e0;
            transform: scale(1.05);
        }
        .is-team-badge {
            background-color: gold;
            color: black;
            padding: 2px 5px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .edit-link {
            display: inline-block;
            margin-top: 10px;
            font-size: 0.9em;
            color: var(--primary-color);
            text-decoration: underline;
        }
        .filter-form {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div style="text-align: center; margin-bottom: 20px;">
            <h2>Els teus Pokémon</h2>
            
            <!-- Type Filter Form -->
            <div class="filter-form">
                <form method="GET">
                    <label for="filter_type">Filtrar per Tipus:</label>
                    <select name="filter_type" id="filter_type" style="padding: 5px;">
                        <option value="">Tots</option>
                        <?php foreach ($all_types as $t): ?>
                            <option value="<?php echo htmlspecialchars($t); ?>" <?php echo $filter_type === $t ? 'selected' : ''; ?>>
                                <?php echo ucfirst($t); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn" style="padding: 5px 15px; font-size: 0.9em;">Filtrar</button>
                    <?php if ($filter_type): ?>
                        <a href="my_pokemon.php" style="margin-left: 10px; text-decoration: none; color: #666;">Netejar</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <p>Ets <strong><?php echo ucfirst($role); ?></strong>. Pots seleccionar fins a <strong><?php echo $limit; ?></strong> Pokémon.</p>
            <?php if ($msg): ?>
                <div style="background: <?php echo strpos($msg, 'Error') !== false ? '#ffcdd2' : '#c8e6c9'; ?>; padding: 10px; border-radius: 5px; display: inline-block;">
                    <?php echo htmlspecialchars($msg); ?>
                </div>
            <?php endif; ?>
        </div>
        
        <form method="POST">
            <div style="text-align: center; margin-bottom: 20px;">
                <button type="submit" class="btn">Guardar Equip</button>
            </div>
            
            <div class="card-grid">
                <?php foreach ($captures as $p): ?>
                    <div style="position: relative;">
                        <!-- Checkbox Logic -->
                        <input type="checkbox" 
                               name="team[]" 
                               value="<?php echo $p['capture_id']; ?>" 
                               id="pk_<?php echo $p['capture_id']; ?>" 
                               class="pokemon-checkbox"
                               <?php echo $p['is_on_team'] ? 'checked' : ''; ?>>
                               
                        <label for="pk_<?php echo $p['capture_id']; ?>" class="pokemon-label">
                            <div class="pokemon-card">
                                <?php if ($p['is_on_team']): ?>
                                    <span class="is-team-badge">A l'equip</span>
                                <?php endif; ?>
                                <img src="<?php echo $p['sprite']; ?>" alt="<?php echo $p['name']; ?>" class="pokemon-img">
                                <h3>
                                    <?php echo $p['nickname'] ? htmlspecialchars($p['nickname']) : ucfirst($p['name']); ?>
                                </h3>
                                <p style="color: #666; font-size: 0.9em;"><?php echo ucfirst($p['name']); ?></p>
                                <div>
                                    <span class="type-badge type-<?php echo $p['type1']; ?>"><?php echo $p['type1']; ?></span>
                                    <?php if ($p['type2']): ?>
                                        <span class="type-badge type-<?php echo $p['type2']; ?>"><?php echo $p['type2']; ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </label>
                        
                        <!-- Edit Button (Outside Label so clicking it doesn't toggle checkbox) -->
                        <div style="text-align: center;">
                            <a href="edit_pokemon.php?id=<?php echo $p['capture_id']; ?>" class="edit-link">Canviar Apodo</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </form>
        
        <?php if (empty($captures)): ?>
            <p style="text-align: center;">No s'han trobat Pokémon. <a href="gacha.php">Ves al Gacha</a> o canvia el filtre.</p>
        <?php endif; ?>
    </div>
    
    <script>
        const limit = <?php echo $limit; ?>;
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const checked = document.querySelectorAll('input[type="checkbox"]:checked');
                if (checked.length > limit) {
                    this.checked = false;
                    alert('Només pots seleccionar ' + limit + ' Pokémon!');
                }
            });
        });
    </script>
</body>
</html>
