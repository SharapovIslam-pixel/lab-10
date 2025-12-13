<?php
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

echo "<h3>Страница $page</h3>";

if ($page > 1) {
    echo "<a href='pagination.php?page=" . ($page - 1) . "'>Назад</a> ";
}

echo "<a href='pagination.php?page=" . ($page + 1) . "'>Вперёд</a>";
