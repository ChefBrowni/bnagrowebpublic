<?php

require 'smtp_config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// PHPMailer fájlok betöltése (helyezd el őket a phpmailer mappában)
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

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

    // Feladó és címzett
    $mail->setFrom(MAIL_FROM, MAIL_FROM_NAME);
    $mail->addAddress('bacsik.barnabas95@gmail.com', 'Teszt Címzett'); // <-- IDE írd a teszt emailcímedet

    // Tartalom
    $mail->isHTML(true);
  $mail->Subject = 'Multispektrális felmérés drónnal – BNBK Agro';

  $mail->Body = '
  <table style="width:100%; max-width:600px; margin:auto; font-family:Arial, sans-serif; background:#fef9f4; color:#333;">
      <tr>
          <td style="padding:20px;">
              <h2 style="text-align:center; color:#000;">BNBK Agro Kft</h2>
              <h3 style="text-align:center;">MULTISPEKTRÁLIS FELMÉRÉS DRÓNNAL</h3>
              <p style="text-align:center; font-size:14px; color:#444;">A drónnal készített multispektrális felmérések segítenek a növény- és talajállapot pontos, célzott felmérésében – hogy csak ott avatkozzon be, ahol valóban szükséges.</p>
              <hr>
              <img src="https://bnbk.hu/newsletter/multispektral-email.jpg" alt="Multispektrális felmérés" style="max-width:100%; border-radius:8px; margin:20px 0;">
              <p style="font-size:14px;">További információért vagy ajánlatért forduljon hozzánk bizalommal.</p>
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

    $mail->send();
    echo '✅ E-mail sikeresen elküldve!';
} catch (Exception $e) {
    echo "❌ Hiba a küldéskor: {$mail->ErrorInfo}";
}
?>
