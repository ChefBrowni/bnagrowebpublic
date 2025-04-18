<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'admin/db.php'; // vagy ahol az adatbáziskapcsolat van

// E-mail cím kinyerése GET paraméterből
$email = $_GET['email'] ?? null;

// Csak akkor mentünk, ha van érvényes email
if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    $stmt = $pdo->prepare("INSERT INTO megnyitasok (email, ip_cim, user_agent) VALUES (?, ?, ?)");
    $stmt->execute([$email, $ip, $userAgent]);
}

// 1x1 px átlátszó PNG küldése
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Expires: 0');

// Átlátszó 1x1-es base64 PNG
echo base64_decode(
    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVQI12NgYGBgAAAABAABJzQnCgAAAABJRU5ErkJggg=='
);
exit;
?>
