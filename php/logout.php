<?php
session_start();

//セッション削除
$_SESSION = [];
session_destroy();
header("Location:  login.php");
exit;
?>