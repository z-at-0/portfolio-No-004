<?php
session_start();
require "db.php";
//ログインチェック
if (!isset($_SESSION['user_id'])) {
    //未ログインならlogin.phpに移動
    header("Location:  login.php");
    exit;
}

//ログイン済ならロール別に振り分け
if ($_SESSION['role']  === 'admin')  {
    header("Location: admin_home.php");
    exit;
}  
// ここから下は通常ユーザー用のページ
    $sql = "SELECT posts.content, posts.created_at, users.name FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt ->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    /*
    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
*/
?>
<h2>通常ユーザーのホームページ</h2>
<p>ようこそ <?php echo htmlspecialchars($_SESSION['user_name']); ?>さん！</p>

<h2>投稿一覧</h2>
<?php foreach ($posts as $post): ?>
    <p>
        <strong><?php echo htmlspecialchars($post["name"]); ?></strong>
        <?php echo $post["created_at"]; ?><br>
        <?php  echo htmlspecialchars($post["content"]); ?>
    </p>        
    <hr>
<?php endforeach; ?>