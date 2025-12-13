<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Выбор языка</title>
</head>
<body>
    <h2>Выберите язык / Select language</h2>
    <form method="post" action="set_language.php">
        <select name="language">
            <option value="ru">Русский</option>
            <option value="en">English</option>
        </select>
        <input type="submit" value="Сохранить">
    </form>
</body>
</html>