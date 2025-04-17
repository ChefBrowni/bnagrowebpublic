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
    $mail->CharSet = 'UTF-8'; // <- ez kell az ékezetekhez

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
        $mail->Subject = 'Multispektrális felmérés drónnal – BNBK Agro';

        // A Canva-kép URL-je (már legyen feltöltve a tárhelyedre!)
        $kep_url = 'https://bnbk.hu/newsletter/multispektral-email.jpg';

        // Profi, reszponzív HTML e-mail tartalom
        $mail->isHTML(true);
      $mail->Subject = 'Drónos megoldások a mezőgazdaságban – BNBK Agro';

      $kep_url = 'https://bnbk.hu/newsletter/multispektral-email.jpg'; // <-- IDE jön a feltöltött képed URL-je

      $mail->Body = '
      <table style="width:100%; max-width:700px; margin:auto; font-family:Arial, sans-serif; background:#fef9f4; color:#333;">
          <tr>
              <td style="padding:20px;">
                  <h2 style="text-align:center; color:#000;">Drónos megoldások a mezőgazdaságban</h2>
                  <p style="text-align:left; font-size:14px; color:#444;">
                      Tisztelt Hölgyem / Uram!
                  </p>
                  <img src="' . $kep_url . '" alt="Multispektrális felmérés" style="width:100%; height:auto; border-radius:8px; margin:20px 0;">
                  <p style="margin-top:30px;">
                      Üdvözlettel,<br>
                      <strong>BNBK Agro Mezőgazdasági Kft.</strong><br>
                      <a href="mailto:marketing@bnbk.hu" style="color:#2f855a;">marketing@bnbk.hu</a>
                  </p>
                  <p style="font-size:12px; color:#777; text-align:center; margin-top:40px;">
                      Ha nem szeretnél több e-mailt kapni tőlünk, <a href="#" style="color:#999;">iratkozz le itt</a>.
                  </p>
              </td>
          </tr>
      </table>
      ';

      $mail->AltBody = 'Tisztelt Hölgyem / Uram! Ez egy e-mail a BNBK Agro rendszertől.';

        $mail->send();
        echo "✅ E-mail sikeresen elküldve $nev részére ($email).<br><br>";
    } catch (Exception $e) {
        echo "❌ Hiba a küldéskor $nev részére ($email): {$mail->ErrorInfo}<br><br>";
    }

    echo '<a href="dashboard.php">⬅️ Vissza az admin felületre</a>';
} else {
    echo '❌ Nem megfelelő kérés.';
}
