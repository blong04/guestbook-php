<?php
$host = 'sql302.infinityfree.com';
$db   = 'if0_40653409_guestbook_db';
$user = 'if0_40653409';
$pass = 'FV4SEsh1nhz'; // nếu có mật khẩu thì điền ở đây
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Kết nối DB thất bại: ' . $e->getMessage());
}
