<?php
require 'session_check.php';
require 'db.php';

$page = $_GET['page'] ?? 'testsend';

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
            <a class="navbar-brand" href="dashboard.php">BNBK Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'testsend' ? 'active' : '' ?>" href="dashboard.php?page=testsend">Tesztküldés</a>
                    </li>
                    <!-- Ide jöhetnek majd új menüpontok -->
                    <!--
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'stats' ? 'active' : '' ?>" href="dashboard.php?page=stats">Statisztika</a>
                    </li>
                    -->
                </ul>
                <span class="navbar-text me-3">Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Kijelentkezés</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if ($page === 'testsend'): ?>
            <?php
            // Lekérjük a kontaktokat a teszttáblából
            $stmt = $pdo->query("SELECT * FROM kontaktok ORDER BY id ASC");
            $kontaktok = $stmt->fetchAll();
            ?>
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
                                        <form method="post" action="send_single.php">
                                            <input type="hidden" name="nev" value="<?= htmlspecialchars($kontakt['nev']) ?>">
                                            <input type="hidden" name="email" value="<?= htmlspecialchars($kontakt['email']) ?>">
                                            <button type="submit" class="btn btn-outline-light btn-sm">Küldés</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <h2>Üdv a BNBK adminfelületen!</h2>
            <p>Válassz funkciót a fenti menüből.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
