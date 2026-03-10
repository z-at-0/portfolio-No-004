<?php
session_start();
require "db.php";
require "process_post.php";
require "get_posts.php";
//管理者ログインチェック
if  (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<h2>管理者用ホームページ</h2>
<p>ようこそ <?php echo htmlspecialchars($_SESSION['user_name']); ?> さん！</p>
<br>
<a href="logout.php">ログアウト</a>

<h2>投稿する</h2>
<form method="POST">
    <textarea name="content" rows="3" cols="40" required></textarea><br>
    <button type="submit">投稿</button> 
</form>

<br>
<h2>投稿一覧</h2>
<?php foreach ($posts as $post): ?>
    <p>
        <strong><?php echo htmlspecialchars($post["name"]); ?></strong>
        <?php echo $post["created_at"]; ?><br>
        <?php echo htmlspecialchars($post["content"]); ?>
        <!-- 管理者は全投稿削除可能 -->
        <a href="delete.php?id=<?php echo $post["id"]; ?>">削除</a>
    </p>
    <hr>
<?php endforeach; ?>