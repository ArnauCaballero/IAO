<?php
    $conexio = mysqli_connect("localhost","root","") or die(mysqli_error());
    mysqli_query($conexio, "CREATE DATABASE IF NOT EXISTS mibd") or die(mysqli_error());
    echo "Base de dades creada correctament<br>";
    mysqli_select_db($conexio, "mibd") or die(mysqli_error());
    $consulta = "CREATE TABLE IF NOT EXISTS mitabla (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(30) NOT NULL)";
    mysqli_query($conexio, $consulta) or die(mysqli_error());
    echo "Taula creada correctament<br>";
    mysqli_close($conexio);
    echo "Base de dades i taula creades correctament";
    
?>