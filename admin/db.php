<?php
$host = 'localhost:3306';
$db   = 'bnbkhuwx_email_kampany'; // ez a te adatbázisod neve
$user = 'bnbkhuwx_barna';         // ezt írd át!
$pass = '513A1D4fc7.1!';                 // ezt is írd át!
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    //echo "✅ Sikeres kapcsolódás az adatbázishoz!";
} catch (\PDOException $e) {
    die("❌ Adatbázis kapcsolódási hiba: " . $e->getMessage());
}
?>
