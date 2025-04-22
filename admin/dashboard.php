<?php
require 'session_check.php';
require 'db.php';
$page = $_GET['page'] ?? '';
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
                    <a class="nav-link <?= $page === 'kampanyok' ? 'active' : '' ?>" href="dashboard.php?page=kampanyok">Kampányok</a>
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

<?php if ($page === ''): ?>

    <h2 class="mb-4">Üdvözlünk a BNBK Adminfelületen!</h2>
    <p>Válassz egy funkciót a fenti menüből a folytatáshoz.</p>

<?php elseif ($page === 'testsend'): ?>

    <?php
    $stmt = $pdo->query("SELECT * FROM kontaktok_test ORDER BY id ASC");
    $kontaktok = $stmt->fetchAll();
    ?>
    <h2 class="mb-4">Teszt kontaktlista</h2>
    <div class="table-responsive">
        <table class="table table-dark table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th><th>Név</th><th>Megye</th><th>E-mail</th><th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kontaktok)): ?>
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

<?php elseif ($page === 'kampany_megnyitasok' && isset($_GET['kuldes_id'])): ?>
<?php elseif ($page === 'kampany_kattintasok' && isset($_GET['kuldes_id'])): ?>

    <?php
    $kuldes_id = (int)$_GET['kuldes_id'];

    $stmt = $pdo->prepare("
        SELECT email, COUNT(*) AS kattintas_db
        FROM kattintasok
        WHERE kuldes_id = ?
        GROUP BY email
        ORDER BY kattintas_db DESC
    ");
    $stmt->execute([$kuldes_id]);
    $kattintok = $stmt->fetchAll();
    ?>

    <h2 class="mb-4">🖱️ Kattintók – kampány #<?= $kuldes_id ?></h2>
    <a href="dashboard.php?page=kampanyok" class="btn btn-secondary btn-sm mb-3">⬅️ Vissza</a>
    <div class="table-responsive">
        <table class="table table-dark table-bordered table-striped">
            <thead>
                <tr>
                    <th>E-mail cím</th>
                    <th>Kattintások száma</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kattintok)): ?>
                    <tr><td colspan="2" class="text-center">Nincs adat ehhez a kampányhoz.</td></tr>
                <?php else: ?>
                    <?php foreach ($kattintok as $k): ?>
                        <tr>
                            <td><?= htmlspecialchars($k['email']) ?></td>
                            <td><?= $k['kattintas_db'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($page === 'megnyitasok'): ?>

    <?php
    $stmt = $pdo->query("
        SELECT
          m.email,
          COUNT(DISTINCT m.id) AS megnyitasok,
          COUNT(DISTINCT k.id) AS kattintasok
        FROM megnyitasok m
        LEFT JOIN kattintasok k
          ON m.email COLLATE utf8mb4_general_ci = k.email COLLATE utf8mb4_general_ci
        GROUP BY m.email
    ");
    $adatok = $stmt->fetchAll();
    ?>
    <h2 class="mb-4">Megnyitások statisztika</h2>
    <div class="table-responsive">
        <table class="table table-dark table-bordered table-striped">
            <thead>
                <tr>
                    <th>E-mail</th><th>Megnyitások száma</th><th>Kattintott?</th><th>Kattintások száma</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($adatok)): ?>
                    <tr><td colspan="4" class="text-center">Nincs adat</td></tr>
                <?php else: ?>
                    <?php foreach ($adatok as $sor): ?>
                        <tr>
                            <td><?= htmlspecialchars($sor['email']) ?></td>
                            <td><?= $sor['megnyitasok'] ?></td>
                            <td><?= $sor['kattintasok'] > 0 ? 'Igen' : 'Nem' ?></td>
                            <td><?= $sor['kattintasok'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php elseif ($page === 'kampanyok'): ?>

    <?php
    $stmt = $pdo->query("
      SELECT
        k.id,
        k.nev,
        COALESCE(m.megnyitasok, 0) AS megnyitasok,
        COALESCE(c.kattintasok, 0) AS kattintasok
      FROM kuldesek k
      LEFT JOIN (
        SELECT kuldes_id, COUNT(DISTINCT email) AS megnyitasok
        FROM megnyitasok
        GROUP BY kuldes_id
      ) AS m ON m.kuldes_id = k.id
      LEFT JOIN (
        SELECT kuldes_id, COUNT(DISTINCT email) AS kattintasok
        FROM kattintasok
        GROUP BY kuldes_id
      ) AS c ON c.kuldes_id = k.id
      ORDER BY k.id DESC
      LIMIT 25
    ");
    $kampanyok = $stmt->fetchAll();
    ?>
    <h2 class="mb-4">Kampányok</h2>
    <a href="../aloldalak/kampany_szerkeszto.php" class="btn btn-success mb-3">Új kampány hozzáadása</a>
    <div class="table-responsive">
        <table class="table table-dark table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kampány neve</th>
                    <th>Megnyitások</th>
                    <th>Kattintások</th>
                    <th>Művelet</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kampanyok)): ?>
                    <tr><td colspan="4" class="text-center">Nincs kampányadat</td></tr>
                <?php else: ?>
                    <?php foreach ($kampanyok as $k): ?>
                        <tr>
                            <td>
                                <a href="dashboard.php?page=kampany_megnyitasok&kuldes_id=<?= $k['id'] ?>">
                                    <?= htmlspecialchars($k['nev']) ?>
                                </a>
                            </td>
                            <td><?= (int)$k['megnyitasok'] ?></td>
                            <td><?= (int)$k['kattintasok'] ?></td>
                            <td>
                                <a href="send_campaign.php?id=<?= $k['id'] ?>"
                                   class="btn btn-primary btn-sm">Küldés</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

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
                    <th>Név</th><th>Email</th><th>Telefon</th><th>Szolgáltatás</th>
                    <th>Felmérések</th><th>Helység</th><th>Terület (ha)</th><th>Esedékesség</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($ajanlatok)): ?>
                    <tr><td colspan="8" class="text-center">Nincs adat</td></tr>
                <?php else: ?>
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
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
