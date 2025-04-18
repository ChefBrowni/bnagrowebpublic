<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'] ?? '';
    $telefon = $_POST['telefon'] ?? '';
    $szolgaltatas = $_POST['szolgaltatas'] ?? '';
    $felmeres_tipusok = $_POST['felmeres_tipusok'] ?? [];
    $helyseg = $_POST['helyseg'] ?? '';
    $terulet = $_POST['terulet'] ?? '';
    $esedekesseg = $_POST['esedekesseg'] ?? '';

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
      <label class="form-label">Felmérés típusa (több is választható)</label><br>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Tápanyag-ellátottság felmérés" id="tapanyag">
        <label class="form-check-label" for="tapanyag">Tápanyag-ellátottság felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Növényállomány felmérés" id="novenyallomany">
        <label class="form-check-label" for="novenyallomany">Növényállomány felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Stresszállapot felmérés" id="stressz">
        <label class="form-check-label" for="stressz">Stresszállapot felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Gyomosodás felmérés" id="gyom">
        <label class="form-check-label" for="gyom">Gyomosodás felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Tőszámlálás" id="toszam">
        <label class="form-check-label" for="toszam">Tőszámlálás</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Vadkár felmérés" id="vadkar">
        <label class="form-check-label" for="vadkar">Vadkár felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Szőlő- és gyümölcs ültetvény felmérés" id="szoloultetveny">
        <label class="form-check-label" for="szoloultetveny">Szőlő- és gyümölcs ültetvény felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Zöldségültetvény felmérés" id="zoldsegultetveny">
        <label class="form-check-label" for="zoldsegultetveny">Zöldségültetvény felmérés</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Talajindex" id="talajindex">
        <label class="form-check-label" for="talajindex">Talajindex</label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="felmeres_tipusok[]" value="Vegetáció" id="vegetacio">
        <label class="form-check-label" for="vegetacio">Vegetáció</label>
      </div>
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
