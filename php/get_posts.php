<?php
//投稿一覧
$sql = "SELECT posts.id, posts.user_id, posts.content, posts.created_at, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);