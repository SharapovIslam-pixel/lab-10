<?php
session_start();
if (!isset($_SESSION['voted'])) {
    $_SESSION['voted'] = false;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$_SESSION['voted']) {
    $vote = $_POST['vote'];
    // сохраняем голос в файл/БД (упрощённо в файл)
    file_put_contents('votes.txt', $vote . "\n", FILE_APPEND);
    $_SESSION['voted'] = true;
    echo "Спасибо за голос!";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Опрос</title>
</head>
<body>
    <h2>Какой язык программирования вам нравится?</h2>
    <?php if ($_SESSION['voted']): ?>
        <p>Вы уже проголосовали.</p>
    <?php else: ?>
        <form method="post">
            <input type="radio" name="vote" value="PHP"> PHP<br>
            <input type="radio" name="vote" value="Python"> Python<br>
            <input type="radio" name="vote" value="JavaScript"> JavaScript<br>
            <input type="submit" value="Голосовать">
        </form>
    <?php endif; ?>
    <a href="results.php">Посмотреть результаты</a>
</body>
</html>