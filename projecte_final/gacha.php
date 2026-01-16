<?php
require_once 'header.php'; // Includes DB and Session Check

$message = '';
$new_pokemon = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['gacha'])) {

    $random_id = rand(1, 1025); // Standard Max

    // PokeAPI Logic
    $api_url = "https://pokeapi.co/api/v2/pokemon/$random_id";
    $json = @file_get_contents($api_url);

    if ($json) {
        $data = json_decode($json, true);

        $pokedex_num = $data['id'];
        $name = $data['name'];
        $height = $data['height'] / 10;
        $weight = $data['weight'] / 10;
        $type1 = $data['types'][0]['type']['name'];
        $type2 = isset($data['types'][1]) ? $data['types'][1]['type']['name'] : NULL;
        $sprite = $data['sprites']['front_default'];

        // Ensure Pokemon is in DB
        $stmt = $pdo->prepare("SELECT id FROM pokemon WHERE pokedex_num = ?");
        $stmt->execute([$pokedex_num]);
        $existing = $stmt->fetch();

        $pokemon_db_id = null;

        if ($existing) {
            $pokemon_db_id = $existing['id'];
        } else {
            // No region_id anymore
            $insert_sql = "INSERT INTO pokemon (pokedex_num, name, type1, type2, height, weight, sprite) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($insert_sql);
            $stmt->execute([$pokedex_num, $name, $type1, $type2, $height, $weight, $sprite]);
            $pokemon_db_id = $pdo->lastInsertId();
        }

        // Add Capture
        $insert_capture = "INSERT INTO captures (user_id, pokemon_id, nickname) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($insert_capture);
        $stmt->execute([$_SESSION['user_id'], $pokemon_db_id, ucfirst($name)]);

        $message = "Has aconseguit un " . ucfirst($name) . "!";
        $new_pokemon = [
            'name' => $name,
            'sprite' => $sprite,
            'type1' => $type1,
            'type2' => $type2
        ];

    } else {
        $message = "Error connectant amb la PokeAPI.";
    }
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gacha Pokemon</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container" style="text-align: center; margin-top: 50px;">
        <h2>Prova sort i aconsegueix un nou Pokémon!</h2>

        <?php if ($new_pokemon): ?>
            <div class="pokemon-card" style="max-width: 300px; margin: 20px auto; animation: pop 0.5s;">
                <img src="<?php echo $new_pokemon['sprite']; ?>" alt="<?php echo $new_pokemon['name']; ?>"
                    class="pokemon-img">
                <h3><?php echo ucfirst($new_pokemon['name']); ?></h3>
                <div>
                    <span
                        class="type-badge type-<?php echo $new_pokemon['type1']; ?>"><?php echo $new_pokemon['type1']; ?></span>
                    <?php if ($new_pokemon['type2']): ?>
                        <span
                            class="type-badge type-<?php echo $new_pokemon['type2']; ?>"><?php echo $new_pokemon['type2']; ?></span>
                    <?php endif; ?>
                </div>
                <p style="color: green; font-weight: bold;">Capturat!</p>
            </div>
        <?php endif; ?>

        <p><?php echo $message; ?></p>

        <form method="POST" style="max-width: 400px; margin: 0 auto;">
            <button type="submit" name="gacha" class="btn" style="font-size: 1.5rem; padding: 20px 40px; width: 100%;">
                TIRAR GACHA
            </button>
        </form>
    </div>
</body>

</html>