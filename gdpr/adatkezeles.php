<?php
$title = "Adatkezelési tájékoztató – BNBK Agro";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      color: #1f1f1f;
    }
    h1, h2 {
      color: #198754;
    }
    .container {
      max-width: 800px;
      padding: 3rem 1rem;
    }
    .footer-link {
      margin-top: 3rem;
      font-size: 0.9rem;
    }
  </style>
</head>
<body>

<div class="container">
  <h1 class="mb-4">Adatkezelési tájékoztató</h1>
  <p><strong>Hatályos: <?= date('2025.04.22') ?></strong></p>

  <h2>1. Az adatkezelő adatai</h2>
  <ul>
    <li><strong>Cégnév:</strong> BNBK Agro Mezőgazdasági Kft.</li>
    <li><strong>Székhely:</strong> 4225 Debrecen, Szirom utca 33</li>
    <li><strong>E-mail:</strong> info@bnbk.hu</li>
    <li><strong>Weboldal:</strong> <a href="https://bnbk.hu">https://bnbk.hu</a></li>
  </ul>

  <h2>2. Az adatkezelés célja</h2>
  <p>Adataidat a következő célokra használjuk fel:</p>
  <ul>
    <li>Ajánlatkérések kezelése</li>
    <li>Drónos mezőgazdasági szolgáltatások nyújtása</li>
    <li>Marketing e-mailek küldése, kampánykövetés</li>
    <li>Jogszabályi kötelezettségek teljesítése</li>
  </ul>

  <h2>3. Kezelt adatok köre</h2>
  <p>Ajánlatkérés esetén:</p>
  <ul>
    <li>Név, e-mail cím, telefonszám</li>
    <li>Szolgáltatás típusa, helyszín, terület, esedékesség</li>
  </ul>
  <p>Marketing esetén:</p>
  <ul>
    <li>E-mail cím, név</li>
    <li>Megnyitási és kattintási statisztika (IP, időpont, eszköz)</li>
  </ul>

  <h2>4. Az adatkezelés jogalapja</h2>
  <ul>
    <li>Ajánlatkérés: szerződés előkészítése</li>
    <li>Marketing: hozzájárulás (visszavonható)</li>
    <li>Statisztika: jogos érdek</li>
  </ul>

  <h2>5. Tárolási időtartam</h2>
  <ul>
    <li>Ajánlatkérések: 2 év</li>
    <li>Marketing adatok: visszavonásig</li>
    <li>Kampánystatisztikák: legfeljebb 12 hónap</li>
  </ul>

  <h2>6. Továbbított adatok</h2>
  <p>Adatokhoz csak a szolgáltató munkatársai és technikai partnerei (pl. tárhelyszolgáltató) férnek hozzá. Harmadik félnek nem adjuk tovább.</p>

  <h2>7. Az érintettek jogai</h2>
  <ul>
    <li>Tájékoztatás kérése</li>
    <li>Helyesbítés, törlés, korlátozás kérése</li>
    <li>Tiltakozás, hozzájárulás visszavonása</li>
    <li>Felügyeleti szervhez fordulás</li>
  </ul>

  <h2>8. Panaszkezelés</h2>
  <p>Ha jogellenes adatkezelést tapasztalsz, fordulhatsz a <strong>Nemzeti Adatvédelmi és Információszabadság Hatósághoz</strong> (NAIH) vagy a bírósághoz.</p>

  <h2>Kapcsolat</h2>
  <p>Kérdés esetén írj: <a href="mailto:info@bnbk.hu">info@bnbk.hu</a></p>

  <p class="footer-link">
    ⬅️ <a href="/">Vissza a főoldalra</a>
  </p>
</div>

</body>
</html>
