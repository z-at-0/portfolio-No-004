<?php
session_start();
require "db.php";

// ログインしていなければログインページへ
if  (!isset($_SESSION["user_id"])) {
    header("Location:  login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $content = $_POST["content"];
    $user_id =  $_SESSION["user_id"];

    $sql = "INSERT INTO posts (user_id, content) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id,  $content]);

    echo "投稿しました";
}

?>
<h2>投稿ページ</h2>
<form  method="POST">
    <textarea name="content"></textarea><br>
    <button type="submit">投稿</button>
</form>