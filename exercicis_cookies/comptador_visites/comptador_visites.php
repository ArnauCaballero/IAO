<?php
// Durada de la cookie (30 dies)
$durada = time() + (30 * 24 * 60 * 60);
// Si no existeix la cookie, inicialitzem a 0
if (!isset($_COOKIE['visites'])) {
    $visites = 0;
} else {
    $visites = (int)$_COOKIE['visites'];
}
// Incrementem el comptador
$visites++;
setcookie('visites', $visites, $durada);
// Missatge de descompte
$missatge = "";
if ($visites >= 10) {
    $missatge = "Oferta exclusiva sols per a tu! Utilitza el codi <strong>BOTIGA50</strong> per obtenir un 50% de descompte.";
} elseif ($visites >= 5) {
    $missatge = "Oferta exclusiva! Utilitza el codi <strong>BOTIGA20</strong> per obtenir un 20% de descompte.";
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Visites: <?php echo $visites; ?></h1>
    <?php if ($missatge): ?>
        <p class="descompte"><?php echo $missatge; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="codi" placeholder="Introdueix el codi de descompte">
        <button type="submit">Comprar</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $codi = trim($_POST["codi"]);
        if ($codi === "BOTIGA20") {
            setcookie('visites', 0, $durada); // Reiniciem el comptador
            $codi = "";
        } elseif ($codi === "BOTIGA50") {
            setcookie('visites', 0, $durada); // Reiniciem el comptador
            $codi = "";
        } else {
            echo "<p>Codi incorrecte.</p>";
        }
    }
    ?>
</body>
</html>
