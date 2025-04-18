<?php
require '../admin/db.php';
$recaptcha_secret = '6Lc21RwrAAAAAj5B_LTUIMp2T7syxgH4_w-4OKC';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['g-recaptcha-response'] ?? '';

    // reCAPTCHA ellenőrzés
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$token");
    $result = json_decode($response, true);

    // DEBUG: Ha hibás, írd ki részletesen a választ
    if (!$result['success']) {
        echo '<div class="alert alert-danger text-center m-5">❌ Hibás reCAPTCHA ellenőrzés.</div>';
        echo '<pre style="background:#f8f9fa;padding:1rem;border-radius:5px;margin:1rem auto;max-width:600px">';
        print_r($result);
        echo '</pre>';
        exit;
    }

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

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Ajánlatkérés – BNBK Agro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://www.google.com/recaptcha/api.js?render=6Lc21RwrAAAAAKaEr4EsT2jkYRNjXnJ_ZUchZOe8"></script>
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Ajánlatkérés</h1>
  <form method="POST" action="" class="bg-white p-4 shadow rounded" novalidate>

    <!-- reCAPTCHA token -->
    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

    <div class="mb-3">
      <label for="nev" class="form-label">Név</label>
      <input type="text" class="form-control" id="nev" name="nev" required>
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">E-mail cím</label>
      <input type="email" class="form-control" id="email" name="email" required oninput="validateEmail()">
      <div id="email-feedback" class="form-text text-danger"></div>
    </div>

    <div class="mb-3">
      <label for="telefon" class="form-label">Telefonszám</label>
      <input type="text" class="form-control" id="telefon" name="telefon" required>
    </div>

    <div class="mb-3">
      <label for="szolgaltatas" class="form-label">Szolgáltatás</label>
      <select class="form-select" id="szolgaltatas" name="szolgaltatas" required onchange="toggleFelmeres(this.value)">
        <option value="">Válassz...</option>
        <option value="Permetezés">Permetezés</option>
        <option value="Felmérés">Felmérés</option>
      </select>
    </div>

    <div class="mb-3" id="felmeres-tipusok" style="display:none;">
      <label class="form-label">Felmérés típusa (több is választható)</label><br>

      <?php
      $felmeresek = [
        "Tápanyag-ellátottság felmérés", "Növényállomány felmérés", "Stresszállapot felmérés",
        "Gyomosodás felmérés", "Tőszámlálás", "Vadkár felmérés",
        "Szőlő- és gyümölcs ültetvény felmérés", "Zöldségültetvény felmérés",
        "Talajindex", "Vegetáció"
      ];
      foreach ($felmeresek as $index => $felmeres) {
          $id = 'felmeres_' . $index;
          echo '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="' . $felmeres . '" id="' . $id . '">
                  <label class="form-check-label" for="' . $id . '">' . $felmeres . '</label>
                </div>';
      }
      ?>
    </div>

    <div class="mb-3">
      <label for="helyseg" class="form-label">Helység</label>
      <input type="text" class="form-control" id="helyseg" name="helyseg" required>
    </div>

    <div class="mb-3">
      <label for="terulet" class="form-label">Munkavégzés területe (ha)</label>
      <input type="text" class="form-control" id="terulet" name="terulet" required>
    </div>

    <div class="mb-3">
      <label for="esedekesseg" class="form-label">Esedékesség</label>
      <input type="date" class="form-control" id="esedekesseg" name="esedekesseg" required>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-success px-4">Ajánlat küldése</button>
    </div>

  </form>
</div>

<script>
  grecaptcha.ready(function () {
    grecaptcha.execute('6Lc21RwrAAAAAKaEr4EsT2jkYRNjXnJ_ZUchZOe8', { action: 'submit' }).then(function (token) {
      document.getElementById('g-recaptcha-response').value = token;
    });
  });
</script>

<script src="../scripts/ajanlatkeres.js"></script>
</body>
</html>
