<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BNBK Agro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
  <footer class="footer-dark text-white pt-5 pb-4">
    <div class="container">

      <div class="row gy-4">

        <div class="col-12 col-md-6">
          <h2 class="h5 mb-3">Hol találsz meg minket?</h2>
          <div class="ratio ratio-16x9 rounded overflow-hidden">
            <!-- cseréld a “q” paramétert a pontos címre, ha megvan -->
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10708.833067721622!2d19.0402352!3d47.497913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4740dc18c8df03fb%3A0x676eebeb7b6e3b9c!2sBudapest!5e0!3m2!1shu!2shu!4v1713716400000!5m2!1shu!2shu"
              loading="lazy" referrerpolicy="no-referrer-when-downgrade"
              title="BNBK Agro térkép‑előnézet"></iframe>
          </div>
        </div>

        <div class="col-12 col-md-6 d-flex flex-column justify-content-between">

          <!-- Kapcsolat -->
          <section itemscope itemtype="https://schema.org/LocalBusiness">
            <h2 class="h5 mb-3">Kapcsolat</h2>
            <p class="mb-1" itemprop="name">BNBK&nbsp;Agro Mezőgazdasági Kft.</p>
            <p class="mb-1">Telefon: <a href="tel:+36704277957" class="text-white text-decoration-none" itemprop="telephone">+36 70 427 7957</a></p>
            <p class="mb-3">E‑mail: <a href="mailto:info@bnbkagro.hu" class="text-white text-decoration-none" itemprop="email">info@bnbk.hu</a></p>
          </section>

          <!-- Mini navigáció -->
          <nav class="mt-auto">
            <ul class="list-inline small mb-0">
              <li class="list-inline-item"><a href="/#home"             class="footer-link">Főoldal</a></li>
              <li class="list-inline-item"><a href="/#process"          class="footer-link">Szolgáltatások</a></li>
              <li class="list-inline-item"><a href="/aloldalak/ajanlatkeres.php" class="footer-link">Ajánlatkérés</a></li>
              <li class="list-inline-item"><a href="/gdpr/aszf.html"          class="footer-link">ÁSZF</a></li>
              <li class="list-inline-item"><a href="/gdpr/adatkezeles.php"   class="footer-link">Adatkezelés</a></li>
            </ul>
          </nav>

        </div>
      </div>

      <hr class="border-light opacity-10 my-4">
      <p class="text-center small mb-0">
        © <?= date('Y') ?> BNBK Agro Kft. – Minden jog fenntartva
      </p>
      <a href="/admin/login.php" class="footer-link" title="Admin bejelentkezés">
         <i class="bi bi-person-circle fs-4"></i>
     </a>
    </div>
  </footer>

  <script src="script/hero-animated.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
