<?php
/** admin/unsubscribe.php
 *  -------------------------------------------
 *  Egyszerű leiratkozó szkript
 *  Paraméter:  email (kötelező, URL‑kódolt)
 *              kuldes_id (opcionális)
 *  -------------------------------------------
 */
declare(strict_types=1);
ini_set('display_errors', 1);           // Átmenetileg: mutassa a hibát
error_reporting(E_ALL);

require_once __DIR__ . '/db.php';       // ha a db.php az admin mappában van

$email      = $_GET['email']     ?? '';
$kuldes_id  = $_GET['kuldes_id'] ?? null;

/* --- 1) alap ellenőrzés ---------------------------------------- */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showResponse(false, 'Érvénytelen e‑mail cím.');
    exit;
}

/* --- 2) frissítés + napló-------------------------------------- */
try {
    $stmt = $pdo->prepare("
        UPDATE kontaktok_test
        SET    leiratkozott = 1,
               leiratkozas_datuma = NOW()
        WHERE  email = ?
    ");
    $stmt->execute([$email]);

    if ($stmt->rowCount()) {
        if ($kuldes_id !== null && is_numeric($kuldes_id)) {
            @$pdo->prepare("
              INSERT INTO unsubscribe_log (email, kuldes_id, datum)
              VALUES (?, ?, NOW())
            ")->execute([$email, $kuldes_id]);
        }
        showResponse(true, 'Sikeresen leiratkoztál hírlevelünkről.');
    } else {
        showResponse(false, 'Ez az e‑mail cím már nem szerepel aktív listánkon.');
    }

} catch (PDOException $e) {
    error_log('Unsubscribe error: '.$e->getMessage());
    showResponse(false, 'Technikai hiba történt. Kérjük, próbáld később.');
}

/* ---------- helper: válasz render ----------------------------- */
function showResponse(bool $ok, string $msg): void
{
    $class = $ok ? 'success' : 'danger';
    ?>
    <!DOCTYPE html>
    <html lang="hu">
