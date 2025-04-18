<?php
file_put_contents(
    'tracker_debug.log',
    date('Y-m-d H:i:s') . ' - tracker hívás: ' . ($_GET['email'] ?? 'nincs email') . PHP_EOL,
    FILE_APPEND
);

require 'db.php';

$email = $_GET['email'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    try {
        $stmt = $pdo->prepare("
            INSERT INTO megnyitasok (email, ip_cim, user_agent)
            VALUES (?, ?, ?)
        ");

        if (!$stmt) {
            $error = $pdo->errorInfo();
            file_put_contents('tracker_debug.log', '⛔ Prepare hiba: ' . $error[2] . PHP_EOL, FILE_APPEND);
        } else {
            $success = $stmt->execute([$email, $ip, $userAgent]);
            if (!$success) {
                $error = $stmt->errorInfo();
                file_put_contents('tracker_debug.log', '⛔ Execute hiba: ' . implode(', ', $error) . PHP_EOL, FILE_APPEND);
            }
        }

    } catch (PDOException $e) {
        file_put_contents('tracker_debug.log', '📛 KIVÉTEL: ' . $e->getMessage() . PHP_EOL, FILE_APPEND);
    }
}

// 1x1 px átlátszó PNG válasz
header('Content-Type: image/png');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Expires: 0');

echo base64_decode(
    'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAEElEQVQI12NgYGBgAAAABAABJzQnCgAAAABJRU5ErkJggg=='
);
exit;
