<?php
require '../admin/session_check.php';
require '../admin/db.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev          = trim($_POST['nev'] ?? '');
    $targy        = trim($_POST['targy'] ?? '');
    $elotartalom  = trim($_POST['elotartalom'] ?? '');
    $utotartalom  = trim($_POST['utotartalom'] ?? '');
    $kep_url      = trim($_POST['kep_url'] ?? '');

    // 1. Validáció
    if ($nev === '' || $targy === '') {
        $errors[] = 'A kampány neve és az e-mail tárgya kötelező.';
    }

    // 2. Fájl feltöltés kezelése, ha választottak fájlt
    if (!empty($_FILES['kep_file']['name'])) {
        $file     = $_FILES['kep_file'];
        $allowed  = ['image/jpeg','image/png','image/gif'];
        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors[] = 'Hiba a fájl feltöltésekor.';
        } elseif (!in_array(mime_content_type($file['tmp_name']), $allowed, true)) {
            $errors[] = 'Csak JPG, PNG vagy GIF képek engedélyezettek.';
        } else {
            $ext         = pathinfo($file['name'], PATHINFO_EXTENSION);
            $basename    = bin2hex(random_bytes(8)) . '.' . $ext;
            $targetDir   = __DIR__ . '/../images';
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $targetPath  = $targetDir . '/' . $basename;
            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                $errors[] = 'A fájl áthelyezése nem sikerült.';
            } else {
                // relatív URL-ként mentjük
                $kep_url = 'https://bnbk.hu/images/' . $basename;
            }
        }
    }

    // 3. Mentés adatbázisba
    if (empty($errors)) {
        $stmt = $pdo->prepare("
            INSERT INTO kuldesek (nev, targy, elotartalom, kep_url, utotartalom)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $nev,
            $targy,
            $elotartalom,
            $kep_url,
            $utotartalom
        ]);
        $success = true;
        // átirányítás a kampányok listára
        header('Location: ../admin/dashboard.php?page=kampanyok');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <title>Kampány szerkesztő – BNBK Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <h2 class="mb-4">Kampány e-mail szerkesztő</h2>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul class="mb-0">
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="bg-secondary p-4 rounded">
    <div class="mb-3">
      <label class="form-label">Kampány neve <span class="text-warning">*</span></label>
      <input type="text" name="nev" class="form-control" value="<?= htmlspecialchars($nev ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">E-mail tárgya <span class="text-warning">*</span></label>
      <input type="text" name="targy" class="form-control" value="<?= htmlspecialchars($targy ?? '') ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Bevezető szöveg (felső rész)</label>
      <textarea name="elotartalom" class="form-control" rows="3"><?= htmlspecialchars($elotartalom ?? '') ?></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Kép feltöltése</label>
      <input type="file" name="kep_file" class="form-control" accept="https://www.bnbk.hu/images*">
      <div class="form-text">JPG, PNG vagy GIF. Ha képfájlt választasz, az URL mező felülíródik.</div>
    </div>
    <div class="mb-3">
      <label class="form-label">Vagy kép URL</label>
      <input type="url" name="kep_url" class="form-control" value="<?= htmlspecialchars($kep_url ?? '') ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Lezáró szöveg (alsó rész)</label>
      <textarea name="utotartalom" class="form-control" rows="3"><?= htmlspecialchars($utotartalom ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Mentés kampányként</button>
    <a href="../admin/dashboard.php?page=kampanyok" class="btn btn-outline-light ms-2">Vissza</a>
  </form>
</div>
</body>
</html>
