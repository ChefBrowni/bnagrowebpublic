<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Itt dolgozhatod fel az adatokat (pl. adatbázisba mentés, email küldés stb.)
    $nev = $_POST['nev'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $szolgaltatas = $_POST['szolgaltatas'] ?? '';
    $felmeres_tipusok = $_POST['felmeres_tipusok'] ?? [];
    $helyseg = $_POST['helyseg'] ?? '';
    $terulet = $_POST['terulet'] ?? '';
    $esedekesseg = $_POST['esedekesseg'] ?? '';

    // Feldolgozás után visszajelzés vagy átirányítás
    echo '<div class="alert alert-success text-center m-5">Köszönjük! Ajánlatkérésedet rögzítettük.</div>';
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Ajánlatkérés – BNBK Agro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Ajánlatkérés</h1>
  <form method="POST" action="" class="bg-white p-4 shadow rounded">

    <div class="mb-3">
      <label for="nev" class="form-label">Név</label>
      <input type="text" class="form-control" id="nev" name="nev" required>
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
      <label for="felmeres_tipusok" class="form-label">Felmérés típusa (több is választható)</label>
      <select class="form-select" name="felmeres_tipusok[]" multiple>
        <option value="Tápanyag-ellátottság felmérés">Tápanyag-ellátottság felmérés</option>
        <option value="Növényállomány felmérés">Növényállomány felmérés</option>
        <option value="Stresszállapot felmérés">Stresszállapot felmérés</option>
        <option value="Gyomosodás felmérés">Gyomosodás felmérés</option>
        <option value="Tőszámlálás">Tőszámlálás</option>
        <option value="Vadkár felmérés">Vadkár felmérés</option>
        <option value="Szőlő- és gyümölcs ültetvény felmérés">Szőlő- és gyümölcs ültetvény felmérés</option>
        <option value="Zöldségültetvény felmérés">Zöldségültetvény felmérés</option>
        <option value="Talajindex">Talajindex</option>
        <option value="Vegetáció">Vegetáció</option>
      </select>
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
  function toggleFelmeres(value) {
    const felmeres = document.getElementById('felmeres-tipusok');
    felmeres.style.display = value === 'Felmérés' ? 'block' : 'none';
  }
</script>

</body>
</html>
