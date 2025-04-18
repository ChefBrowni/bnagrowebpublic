<?php
require 'db.php';

$email = $_GET['email'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    // Csak akkor logoljuk, ha ez nem egy kattintásos hívás
    $stmt = $pdo->prepare("INSERT INTO megnyitasok (email, ip_cim, user_agent, link) VALUES (?, ?, ?, '')");
    $stmt->execute([$email, $ip, $userAgent]);

    // Egy láthatatlan 1x1 px kép
    header('Content-Type: image/gif');
    echo base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
    exit;
}
?>
