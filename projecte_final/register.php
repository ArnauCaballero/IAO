<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['user_id'])) {
    header("Location: gacha.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $birth_date = $_POST['birth_date'];
    $role_name = $_POST['role'];

    // Validations
    if (empty($username) || empty($email) || empty($password) || empty($birth_date)) {
        $error = "Tots els camps són obligatoris.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El format del correu electrònic no és vàlid.";
    } elseif ($password !== $confirm_password) {
        $error = "Les contrasenyes no coincideixen.";
    } elseif (!in_array($role_name, ['trainer', 'vip'])) {
        $error = "Rol no vàlid.";
    } else {
        // Fetch Role ID
        $stmt = $pdo->prepare("SELECT id FROM roles WHERE name = ?");
        $stmt->execute([$role_name]);
        $role_row = $stmt->fetch();

        if (!$role_row) {
            $error = "Error intern: Rol no trobat.";
        } else {
            $role_id = $role_row['id'];

            // Check username unique
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuaris WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetchColumn() > 0) {
                $error = "Aquest nom d'usuari ja existeix.";
            } else {
                // HASH PASSWORD
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert
                $sql = "INSERT INTO usuaris (username, email, password, birth_date, role_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                try {
                    $stmt->execute([$username, $email, $hashed_password, $birth_date, $role_id]);
                    $success = "Compte creat correctament! <a href='login.php'>Inicia sessió aquí</a>.";
                } catch (PDOException $e) {
                    $error = "Error al registrar: " . $e->getMessage();
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Registre - Pokemon Manager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="header">
        <h1>Pokemon Manager</h1>
    </div>

    <div class="container">
        <div class="login-form">
            <h2>Crear Compte</h2>
            <?php if ($error): ?>
                <div style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div style="color: green; margin-bottom: 10px;"><?php echo $success; ?></div>
            <?php endif; ?>

            <?php if (!$success): ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="username">Nom d'usuari</label>
                        <input type="text" id="username" name="username" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correu Electrònic</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contrasenya</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="confirm_password">Confirmar Contrasenya</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="form-group">
                        <label for="birth_date">Data de Naixement</label>
                        <input type="date" id="birth_date" name="birth_date" required>
                    </div>

                    <div class="form-group">
                        <label>Tipus de Compte</label>
                        <div style="display: flex; gap: 20px; margin-top: 5px;">
                            <label style="font-weight: normal;">
                                <input type="radio" name="role" value="trainer" checked> Entrenador (Max 3 Pokemon)
                            </label>
                            <label style="font-weight: normal;">
                                <input type="radio" name="role" value="vip"> VIP (Max 6 Pokemon)
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn">Registrar-se</button>
                </form>
                <p style="margin-top: 15px;">Ja tens compte? <a href="login.php">Inicia sessió</a></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>