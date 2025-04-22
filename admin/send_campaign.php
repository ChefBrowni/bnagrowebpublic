<?php
require 'session_check.php';
require 'db.php';
require 'smtp_config.php';

/* ===== LÁBLÉC‑SEGÉDFÜGGVÉNY betöltése ============================= */
require_once __DIR__ . '/../includes/mailer_helpers.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

/* --- 1. Kampány betöltése --------------------------------------- */
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

/* --- 2. Kontaktok betöltése ------------------------------------- */
$kontakts = $pdo->query("SELECT nev, email FROM kontaktok_test WHERE email IS NOT NULL")
                ->fetchAll(PDO::FETCH_ASSOC);
if (!$kontakts) {
    exit('❌ Nincsenek címzettek.');
}

$hiba = [];  $ok = [];

foreach ($kontakts as $c) {
    $nev   = $c['nev'];
    $email = $c['email'];

    $mail = new PHPMailer(true);
    try {
        /* SMTP beállítások */
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

        /* ----- 3. HTML levél ------------------------------------ */
        $mail->isHTML(true);
        $mail->Subject = $kampany['targy'];

        /* Kattintás‑ és megnyitás‑tracking */
        $eredeti_url = 'https://bnbk.hu/aloldalak/ajanlatkeres.php';
        $click_url   = 'https://bnbk.hu/admin/click.php'
                     . '?email=' . urlencode($email)
                     . '&kuldes_id=' . $kuldes_id
                     . '&link=' . urlencode($eredeti_url);
        $pixel_url   = 'https://bnbk.hu/admin/tracker.php'
                     . '?email=' . urlencode($email)
                     . '&kuldes_id=' . $kuldes_id;

        /* Beágyazott kép (ha van) */
        $cid = '';
        if ($kampany['kep_url']) {
            $filename   = basename($kampany['kep_url']);
            $localPath  = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $filename;
            if (is_file($localPath)) {
                $cid = 'img_' . $kuldes_id;
                $mail->addEmbeddedImage($localPath, $cid, $filename);
            }
        }

        /* ----- 4. E‑mail törzs összeállítása -------------------- */
        $body  = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>';
        $body .= '<h1 style="font-family:Arial,Helvetica,sans-serif;">'
              .  htmlspecialchars($kampany['nev'])
              .  '</h1>';
        $body .= '<p>' . nl2br(htmlspecialchars($kampany['elotartalom'])) . '</p>';

        if ($cid) {
            $body .= '<p><img src="cid:' . $cid . '" alt="" style="max-width:100%;"></p>';
        }

      

        $body .= '<p>' . nl2br(htmlspecialchars($kampany['utotartalom'])) . '</p>';
        $body .= '<img src="' . $pixel_url . '" width="1" height="1" style="display:none;">';

        /* ----- 5. LÁBLÉC HOZZÁFŰZÉSE --------------------------- */
        $body .= email_footer($email, $kuldes_id);

        $body .= '</body></html>';

        $mail->Body    = $body;
        $mail->AltBody = strip_tags($kampany['elotartalom'] . "\n\n" . $kampany['utotartalom']);

        $mail->send();
        $ok[] = $email;

    } catch (Exception $e) {
        $hiba[$email] = $mail->ErrorInfo;
    }
}

/* --- 6. Visszajelző UI ----------------------------------------- */
?>
<!DOCTYPE html><html lang="hu"><head>
  <meta charset="UTF-8">
  <title>Kampány kiküldve</title>
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head><body class="bg-dark text-white">
  <div class="container py-5">
    <h2 class="mb-4">Kampány kiküldés eredménye</h2>

    <?php if ($ok): ?>
      <div class="alert alert-success">
        <strong><?= count($ok) ?></strong> e-mail sikeresen kiküldve.
      </div>
    <?php endif; ?>

    <?php if ($hiba): ?>
      <div class="alert alert-danger">
        <p><strong>Hibák:</strong></p>
        <ul>
          <?php foreach ($hiba as $addr => $err): ?>
            <li><?= htmlspecialchars($addr) ?> — <?= htmlspecialchars($err) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <a href="dashboard.php?page=kampanyok" class="btn btn-secondary">
      ⬅️ Vissza a kampányokhoz
    </a>
  </div>
</body></html>
