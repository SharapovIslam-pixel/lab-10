<?php
require 'db.php';

// Получение всех пользователей
$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список пользователей</title>

    <!-- Подключение внешнего файла стилей -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Список пользователей</h1>

    <a href="add.php" class="add-btn">➕ Добавить нового пользователя</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Email</th>
            <th>Возраст</th>
            <th>Действие</th>
        </tr>

        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['name']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['age'] ?></td>
                <td>
                    <a class="delete-btn" href="delete.php?id=<?= $u['id'] ?>">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>

</body>
</html>
