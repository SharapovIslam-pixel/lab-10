<?php
$theme = $_POST['theme'];
setcookie("site_theme", $theme, time() + (86400 * 30), "/");
header("Location: home.php");
?>