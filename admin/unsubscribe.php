<?php
/** admin/unsubscribe.php  -----------------------------------------
 *  Egyszerű leiratkozó
 *  URL paraméterek:
 *      email      – kötelező
 *      kuldes_id  – opcionális, analytic
 * ----------------------------------------------------------------*/
declare(strict_types=1);
ini_set('display_errors', 1);          // 0-ra kapcsold élesben
error_reporting(E_ALL);

/* --- adatbázis kapcsolat --------------------------------------- */
require_once __DIR__ . '/db.php';      // ha db.php az admin mappában van
// require_once __DIR__ . '/../db.php';   // ← ezt használd, ha eggyel feljebb van

/* --- paraméterek ----------------------------------------------- */
$email      = $_GET['email']     ?? '';
$kuldes_id  = $_GET['kuldes_id'] ?? null;

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showResponse(false, 'Érvénytelen e‑mail cím.');
    exit;
}

/* --- frissítés + napló ----------------------------------------- */
try {
    $pdo->prepare("
        UPDATE kontaktok_test
        SET    leiratkozott = 1,
               leiratkozas_datuma = NOW()
        WHERE  email = ?
    ")->execute([$email]);

    if ($pdo->rowCount()) {
        if ($kuldes_id !== null && is_numeric($kuldes_id)) {
            $pdo->prepare("
              INSERT INTO unsubscribe_log (email, kuldes_id, datum)
              VALUES (?, ?, NOW())
            ")->execute([$email, $kuldes_id]);
        }
        showResponse(true, 'Sikeresen leiratkoztál hírlevelünkről.');
    } else {
        showResponse(false, 'Ez az e‑mail cím már nem szerepel a listánkon.');
    }

} catch (PDOException $e) {
    error_log('Unsubscribe error: '.$e->getMessage());
    showResponse(false, 'Technikai hiba történt. Kérjük, próbáld később.');
}

/* --- helper ----------------------------------------------------- */
function showResponse(bool $ok, string $msg): void
{
    $class = $ok ? 'success' : 'danger';
    ?>
    <!DOCTYPE html>
    <html lang="hu">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Leiratkozás – BNBK Agro</title>
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      </head>
      <body class="bg-light d-flex flex-column justify-content-center" style="min-height:100vh;">
        <div class="container" style="max-width:500px;">
          <div class="alert alert-<?= $class ?> text-center shadow mt-5">
            <?= htmlspecialchars($msg) ?>
          </div>
          <p class="text-center small">
            <a href="/" class="link-secondary">Vissza a főoldalra</a>
          </p>
        </div>
      </body>
    </html>
    <?php
}
?>
