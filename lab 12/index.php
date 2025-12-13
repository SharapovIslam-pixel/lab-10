<?php
$lang = isset($_COOKIE['site_language']) ? $_COOKIE['site_language'] : 'ru';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo ($lang == 'ru') ? 'Главная' : 'Home'; ?>
    </title>
</head>
<body>
    <?php if ($lang == 'ru'): ?>
        <h1>Добро пожаловать!</h1>
        <p>Вы выбрали русский язык.</p>
    <?php else: ?>
        <h1>Welcome!</h1>
        <p>You have chosen English.</p>
    <?php endif; ?>
    <a href="lang_form.php">Изменить язык / Change language</a>
</body>
</html>