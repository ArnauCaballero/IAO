<?php
$nom = $_GET['nom'];
$cognom = $_GET['cognom'];
$nomcomplet = $nom . " " . $cognom;
$mail = $_GET['mail'];
$contacte = $_GET['contacte'];
echo "Missatge rebut," .  $nomcomplet . ". Gràcies per contactar. Et respondrem a" . $mail;
?>