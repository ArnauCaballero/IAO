<?php
session_start(); // Inicia la sesión

// Si ya hay sesión, muestra el usuario y los enlaces
if (isset($_SESSION['usuari'])) {
    echo "<div style='background:#f0f0f0;padding:10px;font-weight:bold;'>
            Usuari: " . htmlspecialchars($_SESSION['usuari']) . "
          </div>";
    echo "<div style='margin-top:10px;'>
            <a href='info1.html'>Ir a Info 1</a> | 
            <a href='info2.html'>Ir a Info 2</a>
          </div>";
} else {
    // Si no hay sesión, comprueba el login
    $fitxer = "usuaris.txt";

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
                // Redirige a la misma página para mostrar la sesión y los enlaces
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                // Si el login falla, redirige a index.html
                header("Location: index.html");
                exit;
            }
        } else {
            echo "<p style='color:red;'>El fitxer d'usuaris no existeix.</p>";
        }
    }
}
?>