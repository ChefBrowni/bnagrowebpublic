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
  <!-- ========== FOOTER ========== -->
  <!-- ========== FOOTER ========== -->
  <footer class="footer-dark text-white py-4">
    <div class="container-sm">            <!-- <<< keskeny container (max‑width ≈ 960 px) -->

      <div class="row g-4 align-items-stretch">

        <!-- TÉRKÉP –  kártyába ágyazva, csak 200 px magas -->
        <div class="col-12 col-md-6">
          <div class="card bg-transparent border-0 h-100">
            <div class="card-body p-0">
              <h2 class="h6 mb-2">Hol találsz meg&nbsp;minket?</h2>
              <div class="ratio ratio-4x3 rounded overflow-hidden shadow-sm" style="min-height:200px;">
                <iframe
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10708.833067721622!2d19.0402352!3d47.497913"
                  loading="lazy" title="BNBK Agro térkép‑előnézet"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
          </div>
        </div>

        <!-- ELÉRHETŐSÉG + MINI NAV  -->
        <div class="col-12 col-md-6 d-flex flex-column">
          <section class="mb-3 small" itemscope itemtype="https://schema.org/LocalBusiness">
            <h2 class="h6 mb-2">Kapcsolat</h2>
            <p class="mb-1" itemprop="name">BNBK&nbsp;Agro Kft.</p>
            <p class="mb-1">Tel.: <a href="tel:+36301234567" class="footer-link" itemprop="telephone">+36 30 123 4567</a></p>
            <p class="mb-0">E‑mail: <a href="mailto:info@bnbkagro.hu" class="footer-link" itemprop="email">info@bnbkagro.hu</a></p>
          </section>

          <nav class="mt-auto">
            <ul class="list-inline small mb-0">
              <li class="list-inline-item"><a href="/#home"  class="footer-link">Főoldal</a></li>
              <li class="list-inline-item"><a href="/#process" class="footer-link">Szolgáltatások</a></li>
              <li class="list-inline-item"><a href="/aloldalak/ajanlatkeres.php" class="footer-link">Ajánlatkérés</a></li>
              <li class="list-inline-item"><a href="/aszf.php"        class="footer-link">ÁSZF</a></li>
              <li class="list-inline-item"><a href="/adatvedelem.php" class="footer-link">Adatkezelés</a></li>
            </ul>
          </nav>
        </div>

      </div>

      <hr class="border-light opacity-10 my-3">
      <p class="text-center small mb-0">© <?= date('Y') ?> BNBK Agro Kft. – Minden jog fenntartva</p>
    </div>
  </footer>

  <script src="script/hero-animated.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
