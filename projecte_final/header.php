<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';

// Cookie Check: If session invalid but cookie exists, try login
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $cookie_id = $_COOKIE['user_id'];

    // Validate ID exists
    $stmt = $pdo->prepare("SELECT u.*, r.name as role_name FROM usuaris u JOIN roles r ON u.role_id = r.id WHERE u.id = ?");
    $stmt->execute([$cookie_id]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role_name'];
    }
}

// Redirect to login if user not logged in (and not on login page)
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($_SESSION['user_id']) && $current_page !== 'login.php') {
    header("Location: login.php");
    exit;
}
?>
<div class="header">
    <h1>Pokemon Gacha World</h1>
    <div class="nav">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="gacha.php">Gacha</a>
            <a href="my_pokemon.php">El meu Equip</a>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="admin_users.php" style="background-color: #d32f2f;">Administració</a>
            <?php endif; ?>
            <a href="logout.php">Sortir (
                <?php echo htmlspecialchars($_SESSION['username']); ?>)
            </a>
        <?php else: ?>
            <a href="login.php">Iniciar Sessió</a>
        <?php endif; ?>
    </div>
</div>