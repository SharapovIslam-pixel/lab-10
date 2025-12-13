<?php
$language = $_POST['language'];
setcookie("site_language", $language, time() + (86400 * 30), "/"); // срок 30 дней
header("Location: index.php");
?>