<?php
if (getenv('DOCKER_ENV')) {
    require __DIR__ . '/config-docker.php';
} else {
    require __DIR__ . '/config-prod.php';
}

$dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Kết nối DB thất bại: ' . $e->getMessage());
}
