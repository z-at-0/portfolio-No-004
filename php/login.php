<?php
session_start();
require "db.php";

if ($_SERVER["REQUEST_METHOD"] ===  "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt  = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($password,  $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"]  = $user["role"];
        $_SESSION["user_name"] = $user["name"];

        //ロール別振り分け
        if ($user["role"] === 'admin') {
            header("Location: admin_home.php");
        } else {
            header("Location: home.php");
        }
        exit;
    } else {
        echo "メールかパスワードが違います";
    }
}

?>

<h2>ログイン</h2>
<form method="POST">
メール<br>
<input type="email" name="email"><br><br>
パスワード<br>
<input type="password"  name="password"><br><br>
<button type="submit">ログイン</button>
</form>