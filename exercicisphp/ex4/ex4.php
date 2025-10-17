<?php
$tipus_musica = $_GET['musica'];
if ($tipus_musica == "rock") {
    echo "Un molt bon grup de rock es ACDC";
}elseif ($tipus_musica == "pop"){
    echo "Un molt bon grup de pop es Black Pink";
}elseif ($tipus_musica == "rap"){
    echo "Un mol bon artista es 7mz";
}elseif ($tipus_musica == "anime"){
    echo "Una de les mijors canson de anime es la bola de drac Z";
}elseif ($tipus_musica == "tecno"){
    echo "Un bon grup de tecno es DAFT PUNK";
};
?>