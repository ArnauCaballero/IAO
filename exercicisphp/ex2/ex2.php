<?php
$euros = $_GET['euros'];
$euroscanviats = $euros * 1.77;
$dolars = $_GET['dolars'];
$dolarscanviats = $dolars * 0.86;
echo "Euros a canviar: " .  $euros . " Valor en dolars" . $euroscanviats . "<br><br>";
echo "Dolars a canviar: " . $dolars . "valor en euros" . $dolarscanviats;
?>