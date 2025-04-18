<?php
require 'db.php';

$email = $_GET['email'] ?? null;

// Naplózás debug fájlba
file_put_contents(
    'tracker_debug.log',
    date('Y-m-d H:i:s') . ' - tracker hívás: ' . ($email ?: 'nincs email') . PHP_EOL,
    FILE_APPEND
);

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO megnyitasok (email, ip_cim, user_agent)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$email, $ip, $userAgent]);

    } catch (PDOException $e) {
        // Naplózás hibák esetén
        file_put_contents(
            'tracker_debug.log',
            date('Y-m-d H:i:s') . ' - 📛 KIVÉTEL: ' . $e->getMessage() . PHP_EOL,
            FILE_APPEND
        );
    }
}

// 1x1 px átlátszó PNG válasz (base64 dekódolva)
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Expires: 0');

echo base64_decode(
    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVQI12NgYGBgAAAABAABJzQnCgAAAABJRU5ErkJggg=='
);
exit;
