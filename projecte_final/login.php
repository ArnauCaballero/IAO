<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';

// Auto-redirect
if (isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) {
    header("Location: gacha.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Join with roles table
    $sql = "SELECT u.*, r.name as role_name 
            FROM usuaris u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.username = :username";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    // Verify Password using Hash
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role_name'];

        setcookie('user_id', $user['id'], time() + (86400 * 30), "/");

        header("Location: gacha.php");
        exit;
    } else {
        $error = "Usuari o contrasenya incorrectes.";
    }
}
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pokemon Manager</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header">
        <h1>Pokemon Manager</h1>
    </div>

    <div class="container">
        <div class="login-form">
            <h2>Iniciar Sessió</h2>
            <?php if ($error): ?>
                <div style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="username">Nom d'usuari</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Contrasenya</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn">Entrar</button>
            </form>

            <p style="margin-top: 15px;">
                No tens compte? <a href="register.php">Registra't aquí</a>
            </p>

            <p style="margin-top: 15px; font-size: 0.9em; border-top: 1px solid #ddd; padding-top: 10px;">
                Nota: Els usuaris d'exemple hauran de ser actualitzats a contrassenyes segures.
                Registra un nou usuari per provar l'algoritme 'password_hash'.
            </p>
        </div>
    </div>
</body>

</html>