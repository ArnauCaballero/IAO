<?php
$preu = $_GET['preu'];
$iva = $_GET['iva'];
$preufinal = $preu + (($preu * $iva)/100);
echo "Preu: " .  $preu . "€ el a IVA afegit: " . $iva . "%" .  "<br>El preu final un cop inclos l'IVA es: " . $preufinal;
?>