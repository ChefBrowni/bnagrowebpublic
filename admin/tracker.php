<?php
// tracker.php – Megnyitás naplózása 1x1 pixellel

ini_set('display_errors', '1');
error_reporting(E_ALL);

require 'db.php';

$email      = $_GET['email'] ?? '';
$kuldes_id  = $_GET['kuldes_id'] ?? null;

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !is_numeric($kuldes_id)) {
    http_response_code(400);
    exit;
}

$ip         = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
$userAgent  = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs ua';

try {
    $stmt = $pdo->prepare("
        INSERT INTO megnyitasok (email, kuldes_id, megnyitas_ideje, ip_cim, user_agent)
        VALUES (?, ?, NOW(), ?, ?)
    ");
    $stmt->execute([$email, $kuldes_id, $ip, $userAgent]);
} catch (PDOException $e) {
    error_log('❌ Megnyitás naplózási hiba: ' . $e->getMessage());
}

// 1x1 GIF pixel válasz
header('Content-Type: image/gif');
echo base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
exit;
