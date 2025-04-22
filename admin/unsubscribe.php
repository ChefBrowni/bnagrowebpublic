<?php
/**  admin/unsubscribe.php
 *   -------------------------------------------
 *   Egyszerű leiratkozó szkript
 *   - Paraméter:  email   (URL‑kódolt)
 *   - Opcionális: kuldes_id (analytic‑hez, de most csak naplózzuk)
 *   -------------------------------------------
 */

declare(strict_types=1);
ini_set('display_errors', 0);          // prod‑ban ne írjuk ki a hibákat
error_reporting(E_ALL);

require_once __DIR__ . '/../db.php';   // ⬅️  útvonalat igazítsd, ha máshol van

$email      = $_GET['email']     ?? '';
$kuldes_id  = $_GET['kuldes_id'] ?? null;

/* --- 1) Alap ellenőrzések --------------------------------------- */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showResponse(false, 'Érvénytelen e‑mail cím.');
    exit;
}


 */
try {
    $sql = "UPDATE kontaktok_test
            SET    leiratkozott = 1,
                   leiratkozas_datuma = NOW()
            WHERE  email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    if ($stmt->rowCount()) {
        // (opcionális) naplózzuk a kuldes_id‑t analitikához
        if (is_numeric($kuldes_id)) {
            $log = $pdo->prepare(
              "INSERT INTO unsubscribe_log (email, kuldes_id, datum)
               VALUES (?, ?, NOW())"
            );
            @$log->execute([$email, $kuldes_id]);
        }
        showResponse(true, 'Sikeresen leiratkoztál hírlevelünkről.');
    } else {
        showResponse(false, 'Ez az e‑mail cím már nem szerepel aktív listánkon.');
    }

} catch (PDOException $e) {
    /* hiba esetén sem mutatjuk a konkrét SQL‑t a felhasználónak */
    error_log('Unsubscribe error: '.$e->getMessage());
    showResponse(false, 'Technikai hiba történt. Kérjük, próbáld később.');
}

/* ---------- Helper: HTML válasz megjelenítése ------------------ */
function showResponse(bool $ok, string $msg): void
{
    $class = $ok ? 'success' : 'danger';
    ?>
    <!DOCTYPE html><html lang="hu"><head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width,initial-scale=1">
      <title>Leiratkozás – BNBK Agro</title>
      <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    </head><body class="bg-light d-flex flex-column justify-content-center" style="min-height:100vh;">
      <div class="container" style="max-width:500px;">
        <div class="alert alert-<?= $class ?> text-center shadow mt-5">
          <?= htmlspecialchars($msg) ?>
        </div>
        <p class="text-center small">
          <a href="/" class="link-secondary">Vissza a főoldalra</a>
        </p>
      </div>
    </body></html>
    <?php
}
