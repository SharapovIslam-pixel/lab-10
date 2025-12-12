<?php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');

    if ($name && $email && $age) { // простая проверка
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $age]);
        header("Location: index.php");
        exit;
    } else {
        echo "Пожалуйста, заполните все поля!";
    }
}
?>
<form method="post">
    <input type="text" name="name" placeholder="Имя"><br>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="number" name="age" placeholder="Возраст"><br>
    <button>Добавить</button>
</form>
