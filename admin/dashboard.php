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
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'megnyitasok' ? 'active' : '' ?>" href="dashboard.php?page=megnyitasok">Megnyitások</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $page === 'ajanlatkeresek' ? 'active' : '' ?>" href="dashboard.php?page=ajanlatkeresek">Ajánlatkérések</a>
                    </li>
                </ul>
                <span class="navbar-text me-3">Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Kijelentkezés</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if ($page === 'testsend'): ?>
            <?php
            $stmt = $pdo->query("SELECT * FROM kontaktok_test ORDER BY id ASC");
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

        <?php elseif ($page === 'megnyitasok'): ?>
            <?php
            $stmt = $pdo->query("SELECT email, COUNT(*) as megnyitasok, SUM(CASE WHEN link = 1 THEN 1 ELSE 0 END) as kattintasok FROM megnyitasok GROUP BY email");
            $adatok = $stmt->fetchAll();
            ?>
            <h2 class="mb-4">Megnyitások statisztika</h2>
            <table class="table table-dark table-bordered table-striped">
                <thead>
                    <tr>
                        <th>E-mail</th>
                        <th>Megnyitások száma</th>
                        <th>Kattintott?</th>
                        <th>Kattintások száma</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($adatok as $sor): ?>
                        <tr>
                            <td><?= htmlspecialchars($sor['email']) ?></td>
                            <td><?= $sor['megnyitasok'] ?></td>
                            <td><?= $sor['kattintasok'] > 0 ? 'Igen' : 'Nem' ?></td>
                            <td><?= $sor['kattintasok'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php elseif ($page === 'ajanlatkeresek'): ?>
            <?php
            $stmt = $pdo->query("SELECT * FROM ajanlatkeresek ORDER BY id DESC");
            $ajanlatok = $stmt->fetchAll();
            ?>
            <h2 class="mb-4">Ajánlatkérések</h2>
            <div class="table-responsive">
                <table class="table table-dark table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Név</th>
                            <th>Email</th>
                            <th>Telefon</th>
                            <th>Szolgáltatás</th>
                            <th>Felmérések</th>
                            <th>Helység</th>
                            <th>Terület (ha)</th>
                            <th>Esedékesség</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ajanlatok as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['nev']) ?></td>
                                <td><?= htmlspecialchars($a['email']) ?></td>
                                <td><?= htmlspecialchars($a['telefon']) ?></td>
                                <td><?= htmlspecialchars($a['szolgaltatas']) ?></td>
                                <td><?= htmlspecialchars($a['felmeres_tipusok']) ?></td>
                                <td><?= htmlspecialchars($a['helyseg']) ?></td>
                                <td><?= htmlspecialchars($a['terulet']) ?></td>
                                <td><?= htmlspecialchars($a['esedekesseg']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
