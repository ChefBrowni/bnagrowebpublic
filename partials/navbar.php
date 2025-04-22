<?php /*
 |------------------------------------------------------------------
 |  BNBK Agro – Bootstrap 5 Navigation Bar (partial)
 |------------------------------------------------------------------
 |  • Fájl: partials/navbar.php
 |  • Használat:  <?php include 'partials/navbar.php'; ?>
 |  • A <a class="navbar-brand"> link mindig a főoldal gyökerére ("/") mutat.
 |    Ha más a szerver‑útvonalad, cseréld ki tetszés szerint.
 |------------------------------------------------------------------
*/ ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container">
    <!-- LOGÓ / BRAND -->
    <a class="navbar-brand" href="/">BNBK&nbsp;Agro</a>

    <!-- MOBIL TOGGLER -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Menü">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- NAV-LINKS -->
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="/#home">Főoldal</a></li>
        <li class="nav-item"><a class="nav-link" href="/aloldalak/szolgaltatasok.php">Szolgáltatások</a></li>
        <li class="nav-item"><a class="nav-link" href="/aloldalak/ajanlatkeres.php">Ajánlatkérés</a></li>
      </ul>
    </div>
  </div>
</nav>
