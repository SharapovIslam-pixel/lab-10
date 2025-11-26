<?php

$a = isset($_GET['a']) ? (float)$_GET['a'] : null;
$b = isset($_GET['b']) ? (float)$_GET['b'] : null;
?>

<form action="calc.php" method="GET">
    <input type="number" name="a" step="any" placeholder="Введите число A" required>
    <input type="number" name="b" step="any" placeholder="Введите число B" required>
    <button type="submit">Рассчитать</button>
</form>

<?php

if ($a !== null && $b !== null) {

    $sum  = $a + $b;
    $diff = $a - $b;
    $prod = $a * $b;
    $quot = ($b != 0) ? ($a / $b) : "деление на ноль невозможно";

    echo "<hr>";
    echo "Сумма: $sum<br>";
    echo "Разность: $diff<br>";
    echo "Произведение: $prod<br>";
    echo "Частное: $quot<br>";
}
?>
