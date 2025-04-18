<?php
require '../admin/db.php';
$recaptcha_secret = '6Lc21RwrAAAAAj5B_LTUIMp2T7syxgH4_w-4OKC';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['g-recaptcha-response'] ?? '';

    // reCAPTCHA ellenőrzés CURL-lel
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'secret' => $recaptcha_secret,
        'response' => $token
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo '<div class="alert alert-danger text-center m-5">❌ CURL hiba: ' . curl_error($ch) . '</div>';
        curl_close($ch);
        exit;
    }

    curl_close($ch);
    $result = json_decode($response, true);

    // DEBUG – válasz kiírása, ha nem sikerült
    if (!$result || !isset($result['success']) || !$result['success']) {
        echo '<div class="alert alert-danger text-center m-5">❌ Hibás reCAPTCHA ellenőrzés.</div>';
        echo '<pre style="background:#f8f9fa; padding:1rem; border-radius:5px; max-width:600px; margin:2rem auto;">';
        echo "Google válasz:\n\n";
        print_r($result);
        echo "</pre>";
        exit;
    }

    // További POST adat feldolgozás
    $nev = $_POST['nev'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $szolgaltatas = $_POST['szolgaltatas'] ?? '';
    $felmeres_tipusok = $_POST['felmeres_tipusok'] ?? [];
    $helyseg = $_POST['helyseg'] ?? '';
    $terulet = $_POST['terulet'] ?? '';
    $esedekesseg = $_POST['esedekesseg'] ?? '';

    $felmeres_szoveg = !empty($felmeres_tipusok) ? implode(', ', $felmeres_tipusok) : null;

    $stmt = $mysqli->prepare("INSERT INTO ajanlatkeresek
        (nev, email, telefon, szolgaltatas, felmeres_tipusok, helyseg, terulet, esedekesseg)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssss", $nev, $email, $telefon, $szolgaltatas, $felmeres_szoveg, $helyseg, $terulet, $esedekesseg);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success text-center m-5">✅ Köszönjük! Ajánlatkérésedet rögzítettük.</div>';
    } else {
        echo '<div class="alert alert-danger text-center m-5">❌ Hiba történt: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}
?>
