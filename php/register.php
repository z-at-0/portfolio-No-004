<?php
require  "db.php";

if  ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"],  PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $password]);

    // 登録成功後に画面を表示してから5秒で遷移
    $message = "登録できました。5秒後にログインページに移動します。";
    $redirect = "login.php";
}
?>

<h2>ユーザー登録</h2>

<?php if (isset($message)) : ?>
    <p><?php echo $message; ?></p>
    <!-- 5秒後に login.php に遷移 -->
    <meta http-equiv="refresh" content="5;url=<?php echo $redirect; ?>">
<?php endif; ?>
<form method="POST">
    名前<br>
    <input type="text" name="username"><br><br>
    メール<br>
    <input type="email" name="email"><br><br>
    パスワード<br>
    <input type="password" name="password"><br><br>
    <button type="submit">登録</button>
</form>