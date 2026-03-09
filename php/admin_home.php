<?php
session_start();
if  (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
echo  "管理者用ホームページです。ようこそ" . $_SESSION['user_name'] .  "さん！";
?>