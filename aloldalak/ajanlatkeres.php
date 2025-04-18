<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajánlatkérés</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      padding: 2rem;
    }
    .form-section {
      background: #fff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      max-width: 700px;
      margin: auto;
    }
  </style>
</head>
<body>
  <div class="form-section">
    <h2 class="mb-4">Ajánlatkérés</h2>
    <form>
      <div class="mb-3">
        <label for="nev" class="form-label">Név</label>
        <input type="text" class="form-control" id="nev" name="nev" required>
      </div>
      <div class="mb-3">
        <label for="telefon" class="form-label">Telefonszám</label>
        <input type="tel" class="form-control" id="telefon" name="telefon" required>
      </div>

      <div class="mb-3">
        <label for="szolgaltatas" class="form-label">Szolgáltatás típusa</label>
        <select class="form-select" id="szolgaltatas" name="szolgaltatas" required>
          <option value="">Válasszon...</option>
          <option value="felmeres">Felmérés</option>
          <option value="permetezes">Permetezés</option>
        </select>
      </div>

      <div class="mb-3 d-none" id="vizsgalatok-container">
        <label for="vizsgalatok" class="form-label">Vizsgálat típus(ok)</label>
        <select class="form-select" id="vizsgalatok" name="vizsgalatok[]" multiple>
          <option>Tápanyag-ellátottság felmérés</option>
          <option>Növényállomány felmérés</option>
          <option>Stresszállapot felmérés</option>
          <option>Gyomosodás felmérés</option>
          <option>Tőszámlálás</option>
          <option>Vadkár felmérés</option>
          <option>Szőlő- és gyümölcs ültetvény felmérés</option>
          <option>Zöldségültetvény felmérés</option>
          <option>Talajindex</option>
          <option>Vegetáció</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="helyseg" class="form-label">Helység</label>
        <input type="text" class="form-control" id="helyseg" name="helyseg" required>
      </div>

      <div class="mb-3">
        <label for="meret" class="form-label">Munkaterület mérete (ha)</label>
        <input type="number" class="form-control" id="meret" name="meret" min="0" step="0.1" required>
      </div>

      <div class="mb-3">
        <label for="datum" class="form-label">Esedékesség</label>
        <input type="date" class="form-control" id="datum" name="datum" required>
      </div>

      <button type="submit" class="btn btn-success">Ajánlat kérése</button>
    </form>
  </div>

  <script>
    document.getElementById('szolgaltatas').addEventListener('change', function () {
      const vizsgalatok = document.getElementById('vizsgalatok-container');
      vizsgalatok.classList.toggle('d-none', this.value !== 'felmeres');
    });
  </script>
</body>
</html>
