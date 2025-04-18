<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'db.php'; // ugyanaz az adatbázis kapcsolat, mint a tracker.php-ben

$email = $_GET['email'] ?? null;
$link = $_GET['link'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $link) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    $stmt = $pdo->prepare("INSERT INTO kattintasok (email, kattintas_ideje, ip_cim, user_agent, link) VALUES (?, NOW(), ?, ?, ?)");
    $stmt->execute([$email, $ip, $userAgent, $link]);

    // 🔁 Átirányítás a valós céloldalra
    header("Location: $link");
    exit;
} else {
    echo "❌ Hibás vagy hiányzó paraméter.";
}
?>
