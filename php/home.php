<?php
session_start();

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
?>
<h2>通常ユーザーのホームページ</h2>
<p>ようこそ <?php echo htmlspecialchars($_SESSION['user_name']); ?>さん！</p>