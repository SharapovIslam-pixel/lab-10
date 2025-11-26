<?php
// ---------- ФУНКЦИИ ----------

// Проверка простого числа
function isPrime($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// Переворот строки
function reverseString($str) {
    return strrev($str);
}

// Среднее значение массива
function average($arr) {
    return count($arr) ? array_sum($arr) / count($arr) : 0;
}

// Перевод массива строк в верхний регистр
function convertToUpper($arr) {
    return array_map('strtoupper', $arr);
}

// Стрелочная функция: квадрат числа
$square = fn($x) => $x * $x;

// Приветствие
function greet($name) {
    echo "<p>Здравствуйте, $name!</p>";
}

// Инкремент по ссылке (подарок: +1 к количеству)
function increment(&$value) {
    $value++;
}

// ---------- ТОВАРЫ В МАГАЗИНЕ ----------

$products = [
    1 => ['name' => 'яблоко',   'price' => 100],
    2 => ['name' => 'банан',    'price' => 150],
    3 => ['name' => 'апельсин', 'price' => 200],
];

// Массив имён товаров в верхнем регистре (используем convertToUpper)
$productNames = array_column($products, 'name');
$productNamesUpper = convertToUpper($productNames);

// Заменим имена в products на верхний регистр
$i = 0;
foreach ($products as $id => &$product) {
    $product['name'] = $productNamesUpper[$i];
    $i++;
}
unset($product); // на всякий случай

// Переменные для результатов
$totalSum = 0;
$totalItems = 0;
$bonusPoints = [];
$messagePrime = "";
$messageAverage = "";
$secretName = "";

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>
</head>
<body>

<h2>Магазин фруктов</h2>

<form method="post">
    <label>Ваше имя:</label><br>
    <input type="text" name="name" required><br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Товар</th>
            <th>Цена (₸)</th>
            <th>Количество</th>
        </tr>
        <?php foreach ($products as $id => $product): ?>
            <tr>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= $product['price'] ?></td>
                <td>
                    <input type="number" name="qty[<?= $id ?>]" min="0" value="0">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <button type="submit">Оформить заказ</button>
</form>

<hr>

<?php
// ---------- ОБРАБОТКА ЗАКАЗА ----------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $qty = $_POST['qty'] ?? [];

    if ($name !== '') {
        // Приветствие
        greet($name);

        // Секретный код: перевёрнутое имя (reverseString)
        $secretName = reverseString($name);
        echo "<p>Ваш секретный код (имя наоборот): <strong>$secretName</strong></p>";
    }

    $itemSums = [];      // суммы по каждому товару
    $quantities = [];    // массив количеств для бонусов и среднего

    foreach ($products as $id => $product) {
        $count = isset($qty[$id]) ? (int)$qty[$id] : 0;
        if ($count > 0) {

            // Подарок: +1 штука каждого выбранного товара
            increment($count); // используем increment(&$value)

            $sum = $count * $product['price'];
            $totalSum += $sum;
            $totalItems += $count;

            $itemSums[] = $sum;
            $quantities[] = $count;

            echo "<p>Товар: {$product['name']}, количество (с подарком): $count, сумма: $sum ₸</p>";
        }
    }

    if ($totalItems > 0) {
        echo "<h3>Итого по корзине:</h3>";
        echo "<p>Общее количество товаров: <strong>$totalItems</strong></p>";
        echo "<p>Общая сумма: <strong>$totalSum ₸</strong></p>";

        // Средняя стоимость покупки (average)
        $avg = average($itemSums);
        $messageAverage = "Средняя сумма по позициям: " . round($avg, 2) . " ₸";
        echo "<p>$messageAverage</p>";

        // Проверка, простое ли количество товаров (isPrime)
        if (isPrime($totalItems)) {
            $messagePrime = "Количество товаров ($totalItems) — простое число! Вам повезло :)";
        } else {
            $messagePrime = "Количество товаров ($totalItems) — не простое число.";
        }
        echo "<p>$messagePrime</p>";

        // Бонусные баллы: квадрат количества каждого товара (array_map + стрелочная функция square)
        $bonusPoints = array_map($square, $quantities);
        echo "<p>Бонусные баллы за товары (квадрат количества):</p>";
        echo "<pre>";
        print_r($bonusPoints);
        echo "</pre>";
    } else {
        echo "<p>Вы ничего не выбрали.</p>";
    }
}
?>

</body>
</html>
