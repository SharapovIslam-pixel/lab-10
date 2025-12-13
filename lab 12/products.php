<?php
session_start();
$products = [
    ['id' => 1, 'name' => 'Ноутбук', 'price' => 50000],
    ['id' => 2, 'name' => 'Мышь', 'price' => 1000],
    ['id' => 3, 'name' => 'Клавиатура', 'price' => 2000]
];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
</head>
<body>
    <h2>Товары:</h2>
    <?php foreach ($products as $product): ?>
        <div>
            <?php echo $product['name']; ?> - <?php echo $product['price']; ?> руб.
            <form method="post" action="add_to_cart.php" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                <input type="submit" value="В корзину">
            </form>
        </div>
    <?php endforeach; ?>
    <hr>
    <a href="cart.php">Перейти в корзину</a>
</body>
</html>