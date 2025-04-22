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

  <div class="ratio ratio-16x9 mb-5">
  <img
    src="../images/boritokep.jpg"
    alt="Multispektrális felmérés illusztráció"
    class="w-100 h-100 object-fit-cover rounded shadow"
    loading="lazy" decoding="async">
</div>

<section class="py-5" style="background:#f3f0e9;">
  <div class="container">
    <h2 class="mb-5 text-center fw-bold">
      Milyen felmérések végezhetők multispektrális<br class="d-none d-md-block">
      dróntechnológiával?
    </h2>

    <div class="row gy-4 justify-content-center mx-auto" style="max-width:1040px;">
      <!-- BAL OSZLOP ------------------------------------------------>
      <div class="col-12 col-md-6">
        <ul class="list-unstyled d-grid gap-4">
          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/1.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Tápanyag‑ellátottság felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/2.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Növényállomány felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/3.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Stresszállapot felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/9.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Gyomosodás felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/4.png" alt="" class="img-fluid">
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
              <img src="../images/icons/5.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Vadkár felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/6.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Szőlő‑ és gyümölcs ültetvény felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/7.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Zöldségültetvény felmérés</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/10.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Talajindex</span>
          </li>

          <li class="d-flex align-items-start">
            <span class="icon-box me-3">
              <img src="../images/icons/11.png" alt="" class="img-fluid">
            </span>
            <span class="fw-bold">Vegetáció diagnosztika</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- =============================================
     Váltott soros bemutató – Szántóföld / Gyümölcsös
================================================ -->
<section class="py-5" style="background:#f3f0e9;">
  <div class="container">

    <!-- ===== Sor 1 : Szántóföldeken ========================= -->
    <div class="row align-items-center gy-4 py-4 border-top border-dark">

      <!-- SZÖVEG BALRA -->
      <div class="col-12 col-md-8">
        <h3 class="fw-bold mb-3">Szántóföldeken</h3>
        <p class="mb-0">
          Visszaigazolást kaphat a talajművelési technológiák hatékonyságáról.
          Ellenőrizheti a vetés, kultivátorozás és a kijuttatás pontosságát, sikerességét,
          definiálhatja a gyengébb tápanyag‑ellátottságú területeket. Megfigyelheti az
          aszály vagy taposás okozta kárt. Belvizes területeket deríthet fel.
          Összehasonlíthatja a különböző fajták genetikai potenciálját, ellenálló
          képességét és stressztűrését. Megvizsgálhatja kezelései eredményességét.
        </p>
      </div>

      <!-- MONITOR KÉP JOBBRA -->
      <div class="col-12 col-md-4 text-center">
        <figure class="device-frame m-auto">
          <img src="../images/image-11.png" alt="Szántóföldi felmérés" class="img-fluid">
          <figcaption class="device-stand"></figcaption>
        </figure>
      </div>
    </div>

    <!-- ===== Sor 2 : Gyümölcsösben =========================== -->
    <div class="row align-items-center gy-4 py-4 border-top border-dark flex-md-row-reverse">

      <!-- SZÖVEG JOBBRA (mobilon felül) -->
      <div class="col-12 col-md-8">
        <h3 class="fw-bold mb-3">Gyümölcsösben, szőlőben</h3>
        <p class="mb-0">
          Támpontot ad a tápanyag‑utánpótlási tervek elkészítésében és kivitelezésében.
          Az egyed szintjén segít meghatározni a tápanyaghiányt és a károsító tényezőket.
          Segít beazonosítani a növényvédelmi és öntözési problémákat.
        </p>
      </div>

      <!-- MONITOR KÉP BALRA -->
      <div class="col-12 col-md-4 text-center">
        <figure class="device-frame m-auto">
          <img src="../images/image-12.png" alt="Gyümölcsös felmérés" class="img-fluid">
          <figcaption class="device-stand"></figcaption>
        </figure>
      </div>
    </div>

  </div>
</section>

<!-- ==========================================================
     DRÓNOS PERMETEZÉS ELŐNYEI
========================================================== -->
<section class="py-5" style="background:#f3f0e9;">
  <div class="container-fluid px-0">
    <!-- HERO 16:9 -->
    <div class="ratio ratio-16x9">
      <img src="../images/banner.jpg"
           alt="Drónok permetezés közben"
           class="w-100 h-100 object-fit-cover">
    </div>
  </div>

  <div class="container py-5">
    <div class="row align-items-center gy-4">

      <!-- BAL: hatszög kép -->
      <div class="col-12 col-md-4 text-center">
        <div class="hexagon mx-auto">
          <img src="../images/1_hex.png" alt="Drón permetezés"
               class="w-100 h-100 object-fit-cover">
        </div>
      </div>

      <!-- JOBB: címsor + bullet lista -->
      <div class="col-12 col-md-8">
        <h2 class="fw-bold mb-4">A drónos permetezés előnyei:</h2>
        <ul class="list-unstyled fs-5 lh-lg">
          <li>🎯 Célzott, hatékony és precíz foltkezelés.</li>
          <li>🌱 Beavatkozás kizárólag ott, ahol tényleg szükséges.</li>
          <li>💧 Akár 90 %-os víz‑ és 50 %-os permetszer‑megtakarítás.</li>
          <li>🚜 Belvizes, sáros területek is könnyen megközelíthetők.</li>
          <li>⛰️ Akadálymentesen kezelhetők meredek lejtők.</li>
          <li>⏱️ Csökkentett munkaigény a jól elkészített repülési tervvel.</li>
        </ul>
      </div>

    </div><!-- /.row -->
  </div><!-- /.container -->
</section>


</div>

<?php require 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
