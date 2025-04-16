<?php
require 'session_check.php';
require 'db.php';

// Lekérjük a kontaktokat a teszttáblából
$stmt = $pdo->query("SELECT * FROM kontaktok_test ORDER BY id ASC");
$kontaktok = $stmt->fetchAll();
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
                <span class="navbar-text me-3">Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Kijelentkezés</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Teszt kontaktlista</h2>

        <div class="table-responsive">
            <table class="table table-dark table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Név</th>
                        <th>Megye</th>
                        <th>E-mail</th>
                        <th>Művelet</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($kontaktok) === 0): ?>
                        <tr><td colspan="5" class="text-center">Nincs adat</td></tr>
                    <?php else: ?>
                        <?php foreach ($kontaktok as $kontakt): ?>
                            <tr>
                                <td><?= $kontakt['id'] ?></td>
                                <td><?= htmlspecialchars($kontakt['nev']) ?></td>
                                <td><?= htmlspecialchars($kontakt['megye']) ?></td>
                                <td><?= htmlspecialchars($kontakt['email']) ?></td>
                                <td>
                                    <button class="btn btn-outline-light btn-sm" disabled>Küldés</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
