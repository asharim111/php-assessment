<?php
session_start();
require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/helpers/logger.php';

if (!isLoggedIn()) {
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = "File upload failed. Please try again.";
        redirect('dashboard.php');
    }
    
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB limit
    
    $fileTmpPath   = $_FILES['file']['tmp_name'];
    $originalName  = basename($_FILES['file']['name']);
    $fileSize      = $_FILES['file']['size'];
    $fileType      = mime_content_type($fileTmpPath);
    $ext           = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if ($fileSize > $maxFileSize) {
        $_SESSION['error'] = "File is too large. Maximum allowed size is 2MB.";
        redirect('dashboard.php');
    }

    if (!in_array($fileType, $allowedMimeTypes) || !in_array($ext, $allowedExtensions)) {
        $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        redirect('dashboard.php');
    }

    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    
    // Create a unique file name
    $newFileName = uniqid('file_', true) . '.' . $ext;
    $destPath = $uploadDir . $newFileName;
    
    try {
        if (move_uploaded_file($fileTmpPath, $destPath)) {
            $_SESSION['success'] = "File uploaded successfully.";
        } else {
            $_SESSION['error'] = "Error moving the uploaded file.";
        }
    } catch (Exception $e) {
        logMessage("File upload error: " . $e->getMessage());
        $_SESSION['error'] = "An error occurred during file upload.";
    }
}

redirect('dashboard.php');
