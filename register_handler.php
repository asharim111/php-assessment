<?php
session_start();
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/helpers/logger.php';

$username = sanitizeInput($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

if (empty($username) || empty($password) || empty($confirmPassword)) {
    $_SESSION['error'] = "All fields are required.";
    redirect('register.php');
}

if ($password !== $confirmPassword) {
    $_SESSION['error'] = "Passwords do not match.";
    redirect('register.php');
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password must be at least 6 characters.";
    redirect('register.php');
}

try {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Username already exists.";
        redirect('register.php');
    }
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([
        'username' => $username,
        'password' => $hashedPassword
    ]);
    
    $_SESSION['success'] = "Registration successful. Please log in.";
    redirect('index.php');
} catch (Exception $e) {
    logMessage("Registration error: " . $e->getMessage());
    $_SESSION['error'] = "An error occurred. Please try again later.";
    redirect('register.php');
}
