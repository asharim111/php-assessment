<?php

// Sanitize input data
function sanitizeInput(string $data): string {
    return htmlspecialchars(trim($data));
}


// Redirect helper
function redirect(string $url): void {
    header("Location: " . $url);
    exit;
}


// Check if user is logged in
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']);
}
