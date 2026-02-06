<?php
require_once 'db_connec.php';
$genere=$_POST['genere'];
$stmt = $pdo->prepare("SELECT * FROM llibres J JOIN autors A ON J.id_autor = A.id WHERE genere = ?");
$stmt->execute([$genere]);
$fila = $stmt->fetch();
$min = $pdo->prepare("SELECT MIN(any_publicacio) AS any_minim FROM llibres J JOIN autors A ON J.id_autor = A.id WHERE genere = ?");
$min->execute([$genere]);
$minim_ayn = $min->fetch();
$max = $pdo->prepare("SELECT MAX(any_publicacio) AS any_maxim FROM llibres J JOIN autors A ON J.id_autor = A.id WHERE genere = ?");
$max->execute([$genere]);
$maxim_any = $max->fetch();
$total = $pdo->prepare("SELECT COUNT(*) AS total_llibres FROM llibres J JOIN autors A ON J.id_autor = A.id WHERE genere = ?");
$total->execute([$genere]);
$total_llibres = $total->fetch();
$total_llibres = $total_llibres['total_llibres']-1;
if ($total_llibres < 0) {
    echo "<p>No s'han trobat llibres del gènere '" . htmlspecialchars($genere) . "'.</p>";
    exit;
}
else {
    echo "<h1 style='text-align: center;'>Llibres del gènere " . htmlspecialchars($genere) . "</h1>";
    echo "<style>
            table { border-collapse: collapse; width: 50%; margin: 20px auto; }
            th, td { border: 1px solid #333; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
            p { text-align: center; font-size: 18px; }
        </style>";
    echo "</head>";
    echo "<body>";

    // Create table
    echo "<table>";

    // Table header
    echo "<tr>";
    echo "<th>Titol</th>"; 
    echo "<th>Autor</th>";
    echo "<th>Pais</th>";
    echo "<th>Any Publicacio</th>";
    echo "</tr>";
    while ($fila = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($fila['titol']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['nom']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['pais']) . "</td>";
            echo "<td>" . htmlspecialchars($fila['any_publicacio']) . "</td>";
            echo "</tr>";
        } 
    // Table rows
    echo "</table>";
    echo "<p>Total de llibres: " . htmlspecialchars($total_llibres) . "</p>"; 
    echo "<p>Any de publicació mínim: " . htmlspecialchars($minim_ayn['any_minim']) . "</p>";
    echo "<p>Any de publicació màxim: " . htmlspecialchars($maxim_any['any_maxim']) . "</p>";
    echo "</body>";
    echo "</html>";
}
?>