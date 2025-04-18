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
    $mail->CharSet = 'UTF-8'; // ékezetek miatt

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

        // HTML sablon betöltése
        $html_body = file_get_contents(__DIR__ . '/../newsletter/bnbk_svg_hirlevel_szoveg_nelkul.html');

        // 🔗 LINK CSERE kattintáskövetésre
        $urleredeti = 'https://bnbk.hu/ajanlatkeres';
        $kattintas_link = 'https://bnbk.hu/admin/click.php?email=' . urlencode($email) . '&link=' . urlencode($urleredeti);
        $html_body = str_replace($urleredeti, $kattintas_link, $html_body);

        // 👁 Pixel beillesztése megnyitáskövetéshez
        $tracker_pixel = '<img src="https://bnbk.hu/admin/tracker.php?email=' . urlencode($email) . '" width="1" height="1" style="display:none;" alt="">';
        $html_body .= $tracker_pixel;

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
