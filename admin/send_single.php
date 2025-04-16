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
        $mail->Subject = 'Egyedi e-mail a BNBK rendszertől';
        $mail->Body    = "<p>Szia <strong>$nev</strong>!</p><p>Ez egy teszt e-mail a BNBK rendszerből. Ha megkaptad, minden működik! 🙂</p>";
        $mail->AltBody = "Szia $nev! Ez egy teszt e-mail a BNBK rendszerből.";

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
