<?php
require 'session_check.php';
require 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

$kampany_id = intval($_GET['id'] ?? 0);
if (!$kampany_id) {
    exit('❌ Érvénytelen kampány azonosító.');
}

// 1. Betöltjük a kampány adatait
$stmt = $pdo->prepare("SELECT * FROM kuldesek WHERE id = ?");
$stmt->execute([$kampany_id]);
$kampany = $stmt->fetch();
if (!$kampany) {
    exit('❌ Nem található a kiválasztott kampány.');
}

$errors = [];
$successCount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // csak 1 csoportunk van: teszt
    // 2a) lekérdezzük a teszt kontaktokat
    $kontStmt = $pdo->query("SELECT nev, email FROM kontaktok_test");
    $kont = $kontStmt->fetchAll();

    // 2b) bejárjuk és küldünk e-mailt
    foreach ($kont as $c) {
        $mail = new PHPMailer(true);
        try {
            // SMTP beállítások (smtp_config.php-ből)
            $mail->isSMTP();
            $mail->Host       = SMTP_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = SMTP_USER;
            $mail->Password   = SMTP_PASS;
            $mail->SMTPSecure = SMTP_SECURE;
            $mail->Port       = SMTP_PORT;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
            $mail->addAddress($c['email'], $c['nev']);

            $mail->isHTML(true);
            $mail->Subject = $kampany['targy'];

            // itt építjük fel a HTML törzset:
            $html  = '<h2>' . htmlspecialchars($kampany['nev']) . "</h2>";
            $html .= '<p>' . nl2br(htmlspecialchars($kampany['elotartalom'])) . "</p>";
            if ($kampany['kep_url']) {
                $html .= '<img src="' . htmlspecialchars($kampany['kep_url']) . '" style="max-width:100%"><br>';
            }
            $html .= '<p>' . nl2br(htmlspecialchars($kampany['utotartalom'])) . "</p>";
            // link- és tracker-pixel ugyanúgy jöhet ide, ha kell

            $mail->Body    = $html;
            $mail->AltBody = strip_tags($kampany['elotartalom'] . "\n\n" . $kampany['utotartalom']);

            $mail->send();
            $successCount++;
        } catch (Exception $e) {
            $errors[] = "Hiba {$c['email']} küldésekor: {$mail->ErrorInfo}";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Kampány küldése – BNBK Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <h2 class="mb-4">„<?= htmlspecialchars($kampany['nev']) ?>” kampány kiküldése</h2>

  <?php if ($successCount): ?>
    <div class="alert alert-success">✅ Sikeresen kiküldve <?= $successCount ?> címre.</div>
  <?php endif; ?>
  <?php if ($errors): ?>
    <div class="alert alert-danger"><ul class="mb-0">
      <?php foreach ($errors as $e): ?>
        <li><?= htmlspecialchars($e) ?></li>
      <?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <form method="post">
    <p>Ez a kampány a <strong>kontaktok_test</strong> csoportnak fog kiküldésre kerülni.</p>
    <button type="submit" class="btn btn-primary">Küldés indítása</button>
    <a href="dashboard.php?page=kampanyok" class="btn btn-secondary ms-2">Vissza a kampányokhoz</a>
  </form>
</div>
</body>
</html>
