<?php
session_start();

// Inicialitzar la cistella si no existeix
if (!isset($_SESSION['cistella'])) {
    $_SESSION['cistella'] = [];
}

// Afegir producte si s'ha enviat el formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producte = $_POST['producte'];
    $preu = (float)$_POST['preu'];
    $quantitat = (int)$_POST['quantitat'];

    // Si ja existeix el producte, sumar quantitat
    if (isset($_SESSION['cistella'][$producte])) {
        $_SESSION['cistella'][$producte]['quantitat'] += $quantitat;
    } else {
        $_SESSION['cistella'][$producte] = ['preu' => $preu, 'quantitat' => $quantitat];
    }
}

echo "<h1>Cistella de la compra</h1>";
if (!empty($_SESSION['cistella'])) {
    echo "<ul>";
    foreach ($_SESSION['cistella'] as $prod => $info) {
        echo "<li>$prod - Quantitat: {$info['quantitat']} - Preu unitari: {$info['preu']} €</li>";
    }
    echo "</ul>";
} else {
    echo "<p>La cistella està buida.</p>";
}

echo '<a href="index.html">Tornar a la botiga</a> | <a href="finalitzar.php">Finalitzar compra</a>';
?>