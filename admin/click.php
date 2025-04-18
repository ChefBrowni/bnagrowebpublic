<?php
require 'db.php';

$email = $_GET['email'] ?? null;
$link = $_GET['link'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL) && $link) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    $stmt = $pdo->prepare("INSERT INTO kattintasok (email, ip_cim, user_agent, link) VALUES (?, ?, ?, ?)");
    $stmt->execute([$email, $ip, $userAgent, $link]);

    header("Location: " . $link);
    exit;
}

echo '❌ Hibás vagy hiányzó paraméter.';
?>
