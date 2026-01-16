<?php
    $conexio = mysqli_connect("localhost","root","","mibd") or die(mysqli_error());
    $SQL="SELECT * FROM mitabla";
    $resultat = mysqli_query($conexio, $SQL) or die (mysqli_error());
    while ($fila = mysqli_fetch_array($resultat)) {
        echo "ID: " . $fila['id'] . " - Nom: " . $fila['nombre'] . "<br>";
    }       
?>