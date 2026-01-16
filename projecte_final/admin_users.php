<?php
require_once 'header.php';

// Access Control
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: gacha.php");
    exit;
}

$msg = '';

// Handle Updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        $id = $_POST['user_id'];
        $role_id = $_POST['role_id'];
        $password = $_POST['password'];

        $sql = "UPDATE usuaris SET role_id = ?";
        $params = [$role_id];

        if (!empty($password)) {
            // HASH THE PASSWORD BEFORE SAVING
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql .= ", password = ?";
            $params[] = $hashed_password;
        }

        $sql .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
            $msg = "Usuari actualitzat correctament.";
        } else {
            $msg = "Error actualitzant usuari.";
        }
    }
}

// Fetch Users with Role Names
$stmt = $pdo->query("SELECT u.*, r.name as role_name FROM usuaris u JOIN roles r ON u.role_id = r.id ORDER BY u.id ASC");
$users = $stmt->fetchAll();

// Fetch Roles for Dropdown
$stmt = $pdo->query("SELECT * FROM roles ORDER BY id ASC");
$roles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Administració d'Usuaris</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: var(--secondary-color);
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Gestió d'Usuaris</h2>

        <?php if ($msg): ?>
            <div style="background: #c8e6c9; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                <?php echo htmlspecialchars($msg); ?>
            </div>
        <?php endif; ?>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuari</th>
                        <th>Email</th>
                        <th>Equip</th>
                        <th>Modificar Rol / Pass</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo $u['id']; ?></td>
                            <td><?php echo htmlspecialchars($u['username']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td>
                                <a href="admin_user_pokemons.php?id=<?php echo $u['id']; ?>" class="btn"
                                    style="padding: 5px 10px; font-size: 0.8rem;">
                                    Veure Pokemons
                                </a>
                            </td>
                            <td>
                                <form method="POST" class="action-form">
                                    <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
                                    <input type="hidden" name="update_user" value="1">

                                    <select name="role_id" style="padding: 5px;">
                                        <?php foreach ($roles as $r): ?>
                                            <option value="<?php echo $r['id']; ?>" <?php echo $u['role_id'] == $r['id'] ? 'selected' : ''; ?>>
                                                <?php echo ucfirst($r['name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <input type="text" name="password" placeholder="Nova contrasenya"
                                        style="padding: 5px; width: 120px;">

                                    <button type="submit" class="btn"
                                        style="padding: 5px 10px; font-size: 0.8rem;">Guardar</button>
                                </form>
                            </td>
                            <td>
                                <!-- Extra actions -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>