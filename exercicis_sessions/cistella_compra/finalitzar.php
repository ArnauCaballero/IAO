<?php
session_start();

echo "<h1>Resum de la compra</h1>";

if (!empty($_SESSION['cistella'])) {
    $total = 0;
    echo "<ul>";
    foreach ($_SESSION['cistella'] as $prod => $info) {
        $subtotal = $info['preu'] * $info['quantitat'];
        $total += $subtotal;
        echo "<li>$prod - {$info['quantitat']} unitats - Subtotal: $subtotal €</li>";
    }
    echo "</ul>";
    echo "<h2>Total: $total €</h2>";

    echo '<form method="post">
            <button type="submit" name="confirmar">Confirmar compra</button>
          </form>';

    if (isset($_POST['confirmar'])) {
        session_destroy();
        echo "<p>Compra confirmada! Gràcies per la seva compra.</p>";
        echo '<a href="index.html">Tornar a la botiga</a>';
    }
} else {
    echo "<p>No hi ha productes a la cistella.</p>";
    echo '<a href="index.html">Tornar a la botiga</a>';
}
?>