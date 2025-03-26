<?php
session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/helpers/logger.php';

$username = sanitizeInput($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username and password are required.";
    redirect('index.php');
}

try {
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        redirect('dashboard.php');
    } else {
        $_SESSION['error'] = "Invalid username or password.";
        redirect('index.php');
    }
} catch (Exception $e) {
    logMessage("Login error: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again later.";
    redirect('index.php');
}
