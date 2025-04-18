<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php';

$email = $_GET['email'] ?? null;
$link = $_GET['link'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $link) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    try {
        // Mentés a kattintasok táblába
        $stmt = $pdo->prepare("
            INSERT INTO kattintasok (email, kattintas_ideje, ip_cim, user_agent, link)
            VALUES (?, NOW(), ?, ?, ?)
        ");
        $stmt->execute([$email, $ip, $userAgent, $link]);
    } catch (PDOException $e) {
        error_log('❌ Kattintás naplózási hiba: ' . $e->getMessage());
    }

    // Biztonságos átirányítás
    header("Location: " . filter_var($link, FILTER_SANITIZE_URL));
    exit;
}

http_response_code(400);
echo '❌ Hibás vagy hiányzó paraméter.';
