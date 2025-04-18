<?php
require 'session_check.php';
require 'db.php';
require 'smtp_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// 1. Kampány betöltése
$kuldes_id = $_GET['id'] ?? null;
if (!$kuldes_id || !is_numeric($kuldes_id)) {
    exit('❌ Érvénytelen kampány azonosító.');
}

$stmt = $pdo->prepare("SELECT nev, targy, elotartalom, kep_url, utotartalom FROM kuldesek WHERE id = ?");
$stmt->execute([$kuldes_id]);
$kampany = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$kampany) {
    exit('❌ A megadott kampány nem található.');
}

// 2. Kontaktok betöltése
$kont_stmt = $pdo->query("SELECT nev, email FROM kontaktok_test WHERE email IS NOT NULL");
$kontakts = $kont_stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($kontakts)) {
    exit('❌ Nincsenek címzettek.');
}

$hiba = [];
$ok = [];

foreach ($kontakts as $c) {
    $nev   = $c['nev'];
    $email = $c['email'];

    $mail = new PHPMailer(true);
    try {
        // SMTP beállítások
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';

        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($email, $nev);

        $mail->isHTML(true);
        $mail->Subject = $kampany['targy'];

        // 3. Kattintáskövető link
        $eredeti_url = 'https://bnbk.hu/aloldalak/ajanlatkeres.php';
        $click_url   = 'https://bnbk.hu/admin/click.php'
                     . '?email=' . urlencode($email)
                     . '&kuldes_id=' . $kuldes_id
                     . '&link=' . urlencode($eredeti_url);

        // 4. Megnyitáskövető pixel
        $pixel_url   = 'https://bnbk.hu/admin/tracker.php'
                     . '?email=' . urlencode($email)
                     . '&kuldes_id=' . $kuldes_id;

        // 5. E-mail törzs összeállítása
        $body = '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>' . htmlspecialchars($kampany['nev']) . '</title></head>
<body style="font-family:Arial,sans-serif; background:#f9f9f9; padding:20px;">
  <h1 style="color:#2f855a;">' . htmlspecialchars($kampany['nev']) . '</h1>
  <p>' . nl2br(htmlspecialchars($kampany['elotartalom'])) . '</p>';

        if (!empty($kampany['kep_url'])) {
            $body .= '<p><img src="' . htmlspecialchars($kampany['kep_url']) . '" alt="" style="max-width:100%;"></p>';
        }

        $body .= '<p><a href="' . $click_url . '" style="display:inline-block; padding:10px 20px; background:#2f855a; color:#fff; text-decoration:none; border-radius:4px;">Ajánlatkérés</a></p>';
        $body .= '<p>' . nl2br(htmlspecialchars($kampany['utotartalom'])) . '</p>';

        // A pixelet a </body> elé illesztjük
        $body .= '<img src="' . $pixel_url . '" width="1" height="1" style="display:none;" alt=""></body></html>';

        $mail->Body    = $body;
        $mail->AltBody = strip_tags($kampany['elotartalom']) . "\n\n" . strip_tags($kampany['utotartalom']);

        $mail->send();
        $ok[] = $email;
    } catch (Exception $e) {
        $hiba[$email] = $mail->ErrorInfo;
    }
}

// 6. Visszajelzés
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Kampány kiküldve</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
  <div class="container py-5">
    <h2 class="mb-4">Kampány kiküldés eredménye</h2>
    <?php if ($ok): ?>
      <div class="alert alert-success">
        <strong><?= count($ok) ?></strong> e-mail elküldve sikeresen.
      </div>
    <?php endif; ?>
    <?php if ($hiba): ?>
      <div class="alert alert-danger">
        <p><strong>Hibák</strong></p>
        <ul>
          <?php foreach ($hiba as $addr => $err): ?>
            <li><?= htmlspecialchars($addr) ?>: <?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <a href="dashboard.php?page=kampanyok" class="btn btn-secondary">⬅️ Vissza a Kampányokhoz</a>
  </div>
</body>
</html>
