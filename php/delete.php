<?php
session_start();
require "db.php";
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
$id = $_GET["id"];
//管理者なら全削除可能　　通常ユーザーは自分の投稿のみ
if ($_SESSION["role"] === "admin"){
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
} else { //自分の投稿だけ削除する
    $sql = "DELETE FROM posts WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id, $_SESSION["user_id"]]);

    //削除できなかった場合(他人の投稿)
    if($stmt->rowCount() === 0){
        echo "<script>
        alert('この投稿は削除できません(他のユーザーの投稿の可能性があります)');
        location.href='home.php';
        </script>";
        exit;
    }
}
header("Location: home.php");
exit;