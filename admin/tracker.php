<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

$email = $_GET['email'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    try {
        // FIGYELEM: a 'link' mezőt kihagyjuk, ha NULL-t nem enged
        $stmt = $pdo->prepare("
            INSERT INTO megnyitasok (email, ip_cim, user_agent)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$email, $ip, $userAgent]);
    } catch (PDOException $e) {
        error_log("📛 TRACKER ERROR: " . $e->getMessage());
    }
}

// Válaszként 1x1 px átlátszó PNG-t küldünk
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Expires: 0');

echo base64_decode(
    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVQI12NgYGBgAAAABAABJzQnCgAAAABJRU5ErkJggg=='
);
exit;
