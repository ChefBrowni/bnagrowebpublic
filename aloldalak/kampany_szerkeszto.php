<?php
require '../admin/session_check.php';
require '../admin/db.php';

// Mentés adatbázisba
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'] ?? '';
    $targy = $_POST['targy'] ?? '';
    $elotartalom = $_POST['elotartalom'] ?? '';
    $utotartalom = $_POST['utotartalom'] ?? '';
    $kep_url = $_POST['kep_url'] ?? '';

    if ($nev && $targy) {
        $stmt = $pdo->prepare("INSERT INTO kuldesek (nev, targy, elotartalom, kep_url, utotartalom) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nev, $targy, $elotartalom, $kep_url, $utotartalom]);
        header('Location: ../admin/dashboard.php?page=kampanyok');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Kampány szerkesztő</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
    <h2 class="mb-4">Kampány e-mail szerkesztő</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Kampány neve</label>
            <input type="text" name="nev" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email tárgya</label>
            <input type="text" name="targy" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Bevezető szöveg (felső rész)</label>
            <textarea name="elotartalom" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Kép URL (pl. feltöltött PNG)</label>
            <input type="url" name="kep_url" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Lezáró szöveg (alsó rész)</label>
            <textarea name="utotartalom" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Mentés kampányként</button>
        <a href="../admin/dashboard.php?page=kampanyok" class="btn btn-secondary ms-2">Vissza</a>
    </form>
</div>
</body>
</html>
