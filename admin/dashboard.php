<?php
require 'session_check.php';
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>BNBK Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">BNBK Admin</a>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!
                </span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Kijelentkezés</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Admin Kezdőlap</h2>
        <p class="lead">Innen fogod vezérelni a levelek kiküldését és a kontaktokat.</p>

        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title">Fejlesztés alatt</h5>
                <p class="card-text">Hamarosan megjelenik a kontaktlista, a küldés gomb és a statisztika.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
