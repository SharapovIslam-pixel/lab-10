<?php
$q = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : "";

echo "<h3>Поиск</h3>";

if ($q !== "") {
    echo "Вы искали: <b>$q</b>";
} else {
    echo "Поисковый запрос не задан";
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    echo "<br><br><a href='{$_SERVER['HTTP_REFERER']}'>Вернуться назад</a>";
}
