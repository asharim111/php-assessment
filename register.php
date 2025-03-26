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
    <title>Register</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <form id="registerForm" action="register_handler.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username">
        <div class="error" id="usernameError"></div><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password">
        <div class="error" id="passwordError"></div><br>
        
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password">
        <div class="error" id="confirmPasswordError"></div><br>
        
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="index.php">Login here</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="public/assets/js/script.js"></script>
</body>
</html>
