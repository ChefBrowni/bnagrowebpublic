<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BNBK Agro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- külső stíluslap -->
  <link href="style/style.css" rel="stylesheet">
</head>
  <body class="bg-light">


  <!-- NAVBAR -->
  <?php include 'partials/navbar.php'; ?>


  <!-- FŐOLDAL VIDEÓS SZEKCIÓ -->
  <section id="home" class="py-0 position-relative">
    <div class="ratio ratio-16x9">
      <video
        autoplay muted loop playsinline preload="metadata"
        poster="images/videos/menu_video_poster.jpg"
        style="object-fit:cover; width:100%; height:100%;">
        <source src="images/videos/menu_video1.mp4" type="video/mp4">
        A böngésződ nem támogatja a HTML5 videót.
      </video>
    </div>

    <!-- RESPONSIVE OVERLAY -->
    <div class="overlay text-center text-white">
      <h1 class="display-6 display-md-5 display-lg-4 mb-2">Drónpilóta szolgáltatások</h1>
      <p class="lead fs-6 fs-md-5">Mi segítünk a mezőgazdaság modernizációjában drónos megoldásokkal.</p>
    </div>
  </section>
  <!-- ===== KÉPES SZEKCIÓ ===== -->
  <!-- ============ KÉPES SZEKCIÓ + FORM ============ -->
  <section id="process" class="py-5 bg-light">
    <div class="row g-4 process-row">
    <div class="col-12 col-lg-6">
      <div class="ratio ratio-4x3">                 <!-- <<< FIX 4:3 ARÁNY -->
        <img src="images/folyamat_abra.svg" loading="lazy" decoding="async" class="object-contain w-100 h-100" alt="Permetezés folyamatábra" >
      </div>
    </div>

    <div class="col-12 col-lg-6">
      <div class="ratio ratio-4x3">
        <img src="images/dron_allo.jpg" loading="lazy" decoding="async"   class="object-cover w-100 h-100" alt="Permetező drón munka közben">
      </div>
    </div>
  </div>



    </div>
  </section>


  <!-- FOOTER -->
  <footer class="py-4 bg-success text-white text-center">
    <div class="container">
      © <?= date('Y') ?> BNBK Agro Kft. – Minden jog fenntartva
    </div>
  </footer>
  <script src="script/hero-animated.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
