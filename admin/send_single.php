<?php
require 'smtp_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'] ?? '';
    $email = $_POST['email'] ?? '';

    if (empty($nev) || empty($email)) {
        exit('❌ Hiányzó adat. Név vagy e-mail cím nincs megadva.');
    }

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;

        $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
        $mail->addAddress($email, $nev);

        $mail->isHTML(true);
        $mail->Subject = 'Drónos megoldások a mezőgazdaságban – BNBK Agro';

        // 🔗 Kattintáskövető link (külön kattintás log)
        $eredeti_url = 'https://bnbk.hu/aloldalak/ajanlatkeres.php';
        $kattintas_link = 'https://bnbk.hu/admin/click.php?email=' . urlencode($email) . '&link=' . urlencode($eredeti_url);

        // ✉️ HTML e-mail sablon
        $html_body = '<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>BNBK Teszt</title>
</head>
<body style="font-family:Arial,sans-serif; background:#f9f9f9; padding:20px;">
  <h1 style="color:#2f855a;">BNBK Agro Kft – Teszt e-mail</h1>
  <p>Kedves ' . htmlspecialchars($nev) . '!</p>
  <p>Ez egy teszt e-mail a rendszer működésének ellenőrzésére.</p>
  <a href="' . $kattintas_link . '" style="display:inline-block; padding:10px 20px; background:#2f855a; color:#fff; text-decoration:none; border-radius:4px;">Ajánlatkérés</a>';

        // 👁 Megnyitáskövető pixel (csak 1x töltődik be, az e-mail nyitásakor)
        $tracker_pixel = '<img src="https://bnbk.hu/admin/tracker.php?email=' . urlencode($email) . '&r=' . uniqid() . '" width="1" height="1" style="display:none;" alt="">';

        $html_body .= $tracker_pixel . '</body></html>';

        $mail->Body = $html_body;
        $mail->AltBody = 'Tisztelt Hölgyem / Uram! Kérjük, engedélyezze a HTML megjelenítést az e-mailben.';

        $mail->send();
        echo "✅ E-mail sikeresen elküldve $nev részére ($email).<br><br>";
    } catch (Exception $e) {
        echo "❌ Hiba a küldéskor $nev részére ($email): {$mail->ErrorInfo}<br><br>";
    }

    echo '<a href="dashboard.php">⬅️ Vissza az admin felületre</a>';
} else {
    echo '❌ Nem megfelelő kérés.';
}
?>
