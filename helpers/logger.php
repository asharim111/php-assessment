<?php

function logMessage(string $message): void {
    $logFile = dirname(__DIR__, 1) . '\logs\app.log';
    $date = (new DateTime())->format('Y-m-d H:i:s');
    error_log("[$date] " . $message . PHP_EOL, 3, $logFile);
}
