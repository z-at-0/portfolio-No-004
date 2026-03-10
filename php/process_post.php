<?php
//投稿
if ($_SERVER["REQUEST_METHOD"] === "POST")  {
$content = $_POST["content"];
$sql = "INSERT INTO posts (user_id, content) VALUE (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION["user_id"],  $content]);
}