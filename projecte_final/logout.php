<?php
session_start();

// Destroy Session
session_destroy();

// Destroy Cookie
if (isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, "/");
}

// Redirect to index.html (Requirement)
header("Location: index.html");
exit;
?>