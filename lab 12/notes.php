<?php
session_start();
if (!isset($_SESSION['notes'])) {
    $_SESSION['notes'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['note'])) {
    $_SESSION['notes'][] = $_POST['note'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мои заметки</title>
</head>
<body>
    <h2>Добавить заметку:</h2>
    <form method="post">
        <textarea name="note" rows="3" cols="50"></textarea><br>
        <input type="submit" value="Добавить">
    </form>

    <h2>Список заметок:</h2>
    <?php if (empty($_SESSION['notes'])): ?>
        <p>Заметок пока нет.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($_SESSION['notes'] as $note): ?>
            <li><?php echo htmlspecialchars($note); ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="clear_notes.php">
        <input type="submit" value="Очистить все заметки">
    </form>
</body>
</html>