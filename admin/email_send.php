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
    $mail->Subject = 'Teszt e-mail a BNBK rendszerből';
    $mail->Body    = '<b>Szia!</b><br>Ez egy teszt e-mail a BNBK rendszerből.';
    $mail->AltBody = 'Szia! Ez egy teszt e-mail a BNBK rendszerből.';

    $mail->send();
    echo '✅ E-mail sikeresen elküldve!';
} catch (Exception $e) {
    echo "❌ Hiba a küldéskor: {$mail->ErrorInfo}";
}
?>
