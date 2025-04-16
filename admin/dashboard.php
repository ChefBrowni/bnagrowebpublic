<?php
require 'session_check.php';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Admin felület</title>
</head>
<body>
    <h2>Üdv, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <p>Sikeresen beléptél. Innen fogjuk vezérelni a kiküldést.</p>
    <a href="logout.php">Kijelentkezés</a>
</body>
</html>
