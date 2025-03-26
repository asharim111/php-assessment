<?php
session_start();
require_once __DIR__ . '/helpers/functions.php';
if (!isLoggedIn()) {
    redirect('index.php');
}

$username = $_SESSION['username'];
$error = $_SESSION['error'] ?? '';
$success = $_SESSION['success'] ?? '';
unset($_SESSION['error'], $_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?= htmlspecialchars($username) ?></h2>
    <p><a href="logout.php">Logout</a></p>
    
    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?= $success ?></div>
    <?php endif; ?>
    
    <h3>Upload a File</h3>
    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <div class="error" id="uploadError"></div><br>
        <button type="submit">Upload</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="public/assets/js/script.js"></script>
</body>
</html>
