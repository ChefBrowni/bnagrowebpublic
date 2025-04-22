<?php
// szolgaltatasok.php – Szolgáltatások bemutató oldal
require 'partials/navbar.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Szolgáltatásaink – BNBK Agro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <h1 class="mb-4 text-center">Szolgáltatásaink</h1>
  <p class="text-center lead">
    Fedezd fel drónos felmérési és permetezési megoldásainkat, amelyekkel időt, költséget és energiát spórolhatsz.
  </p>

  <div class="text-center my-4">
    <img src="images/szolgaltatasok/banner.png" alt="Szolgáltatásaink" class="img-fluid shadow rounded">
  </div>

  <div class="text-center">
    <a href="images/szolgaltatasok/hirlevel.html" class="btn btn-success btn-lg" target="_blank">
      📄 Részletes bemutató (HTML)
    </a>
  </div>
</div>

<?php require 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
