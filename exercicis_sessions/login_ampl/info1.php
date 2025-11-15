<?php
session_start();
if (!isset($_SESSION['usuari'])) {
    header("Location: index.html");
    exit;
}
echo "<div style='background:#f0f0f0;padding:10px;font-weight:bold;'>
        Usuari: " . htmlspecialchars($_SESSION['usuari']) . "
        | <a href='login_ampl.php?logout=true'>Desconnectar</a>
      </div>";
echo "<h2>Contingut de Info 1</h2>";
?>