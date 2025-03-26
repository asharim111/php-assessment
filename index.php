<?php
session_start();
require_once __DIR__ . '/helpers/functions.php';

if (isLoggedIn()) {
    redirect('dashboard.php');
}

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form id="loginForm" action="login_handler.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username">
        <div class="error" id="usernameError"></div><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password">
        <div class="error" id="passwordError"></div><br>
        
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="public/assets/js/script.js"></script>
</body>
</html>
