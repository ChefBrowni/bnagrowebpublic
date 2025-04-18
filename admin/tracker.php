<?php
require 'db.php';

$email = $_GET['email'] ?? null;

if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'ismeretlen';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'nincs user-agent';

    // Csak akkor logoljuk, ha ez nem egy kattintás (link paraméter NINCS jelen)
    if (!isset($_GET['link'])) {
        $stmt = $pdo->prepare("INSERT INTO megnyitasok (email, ip_cim, user_agent, link) VALUES (?, ?, ?, '')");
        $stmt->execute([$email, $ip, $userAgent]);
    }

    // Láthatatlan 1x1 px kép (GIF)
    header('Content-Type: image/gif');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Expires: 0');
    echo base64_decode('R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
    exit;
} else {
    http_response_code(400);
    echo 'Hibás vagy hiányzó e-mail cím';
    exit;
}
?>
