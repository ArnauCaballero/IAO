<?php
session_start();

$fitxer = "usuaris.txt";

// Si el usuario quiere desloguearse
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit;
}

// Si ya hay sesión activa, mostrar enlaces
if (isset($_SESSION['usuari'])) {
    echo "<div style='background:#f0f0f0;padding:10px;font-weight:bold;'>
            Usuari: " . htmlspecialchars($_SESSION['usuari']) . "
            | <a href='?logout=true'>Desconnectar</a>
          </div>";
    echo "<p><a href='info1.php'>Anar a Info 1</a> | <a href='info2.php'>Anar a Info 2</a></p>";
    exit;
}

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuariForm = $_POST['usuari'] ?? '';
    $passForm = $_POST['contrasenya'] ?? '';

    if (file_exists($fitxer)) {
        $linies = file($fitxer, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $loginCorrecte = false;

        foreach ($linies as $linia) {
            list($usuariFitxer, $passFitxer) = explode(":", $linia);
            if ($usuariForm === $usuariFitxer && $passForm === $passFitxer) {
                $loginCorrecte = true;
                $_SESSION['usuari'] = $usuariForm;
                break;
            }
        }

        if ($loginCorrecte) {
            header("Location: login_ampl.php");
            exit;
        } else {
            header("Location: index.html");
            exit;
        }
    } else {
        echo "<p style='color:red;'>El fitxer d'usuaris no existeix.</p>";
    }
}
?>