<?php
$cookie_name = 'visit_count';
if (!isset($_COOKIE[$cookie_name])) {
    $count = 1;
    setcookie($cookie_name, $count, time() + (86400 * 365));
} else {
    $count = $_COOKIE[$cookie_name] + 1;
    setcookie($cookie_name, $count, time() + (86400 * 365));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Счётчик посещений</title>
</head>
<body>
    <h2>Вы посетили эту страницу <?php echo $count; ?> раз</h2>
    <p>Cookie сохраняется на год.</p>
    <a href="reset_visits.php">Сбросить счётчик</a>
</body>
</html>