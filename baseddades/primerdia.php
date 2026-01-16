<?php 
    $a="Arnau";
    $b="caballero@gmail.com";
    $c="ASIX1";

    $conexio = mysqli_connect("localhost","root","","base1") or die("No s'ha pogut connectar a la base de dades");
    mysqli_query($conexio, "INSERT INTO alumnos (nombre, email, codigocurso) VALUES ('$a', '$b', '$c')") or die("No s'ha pogut inserir les dades");
    mysqli_close($conexio);
    echo "Dades inserides correctament";
?>