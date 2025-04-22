<?php
// szolgaltatasok.php – Szolgáltatások bemutató oldal
require '../partials/navbar.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Szolgáltatásaink – BNBK Agro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../style/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Szolgáltatásaink</h1>
  <p class="text-center lead">
    Fedezd fel drónos felmérési és permetezési megoldásainkat, amelyekkel időt, költséget és energiát spórolhatsz.
  </p>

  <section class="bg-light py-5">
  <div class="container">
    <h2 class="mb-5 text-center fw-bold">
      Milyen felmérések végezhetők multispektrális<br class="d-none d-md-block">
      dróntechnológiával?
    </h2>

    <div class="row gy-4 justify-content-center">
      <!-- BAL OSZLOP ------------------------------------------------>
      <div class="col-12 col-md-6">
        <ul class="list-unstyled d-grid gap-4">
          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/tapanyag.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Tápanyag‑ellátottság felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/novenyallomany.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Növényállomány felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/stressz.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Stresszállapot felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/gyom.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Gyomosodás felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/toszamlas.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Tőszámlálás</span>
          </li>
        </ul>
      </div>

      <!-- JOBB OSZLOP ---------------------------------------------->
      <div class="col-12 col-md-6">
        <ul class="list-unstyled d-grid gap-4">
          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/vadkar.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Vadkár felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/gyumolcs.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Szőlő‑ és gyümölcs ültetvény felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/zoldseg.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Zöldségültetvény felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/talajindex.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Talajindex</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="images/icons/vegetacio.svg" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Vegetáció diagnosztika</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>



</div>

<?php require 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
