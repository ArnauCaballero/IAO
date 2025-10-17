<?php
$hora = date("H");
echo "La hora es: " . $hora . "<br><br>";
if ($hora > 5 && $hora < 14) {
    echo "Bon dia";
}elseif ($hora > 14 && $hora < 19 ){
    echo "Bona tarda";
}else{
    echo "Bona nit";
}
?>