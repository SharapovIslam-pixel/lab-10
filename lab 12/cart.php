<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
</head>
<body>
    <h2>Ваша корзина:</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Корзина пуста.</p>
    <?php else: ?>
        <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li>Товар ID: <?php echo $item['id']; ?> — Количество: <?php echo $item['quantity']; ?></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="products.php">Продолжить покупки</a> | 
    <a href="clear_cart.php">Очистить корзину</a>
</body>
</html>