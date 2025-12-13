<?php
$theme = isset($_COOKIE['site_theme']) ? $_COOKIE['site_theme'] : 'light';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <style>
        body.light { background: white; color: black; }
        body.dark { background: #222; color: white; }
    </style>
</head>
<body class="<?php echo $theme; ?>">
    <h1>Добро пожаловать!</h1>
    <p>Текущая тема: <?php echo $theme; ?></p>
    <a href="theme_form.php">Изменить тему</a>
</body>
</html>