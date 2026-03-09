<?php

$dsn = "mysql:host=localhost;dbname=bbs_app;charset=utf8mb4";
$user = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo "DB接続エラー";
    exit;
}