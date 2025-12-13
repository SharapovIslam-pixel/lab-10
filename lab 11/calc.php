<?php
$a = isset($_GET['a']) ? (int)$_GET['a'] : 0;
$b = isset($_GET['b']) ? (int)$_GET['b'] : 0;

echo "Сумма: " . ($a + $b) . "<br>";
echo "Разность: " . ($a - $b) . "<br>";
echo "Произведение: " . ($a * $b) . "<br>";

if ($b != 0) {
    echo "Частное: " . ($a / $b);
} else {
    echo "Частное: деление на ноль невозможно";
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    echo "<br><br><a href='{$_SERVER['HTTP_REFERER']}'>Вернуться назад</a>";
}
