<?php
require "db.php";

$id = $_GET["id"] ?? null;

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) die("Пользователь не найден");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
    $stmt->execute([$name, $email, $id]);

    header("Location: index.php");
    exit;
}
?>

<form method="post">
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
    <input type="text" name="email" value="<?= htmlspecialchars($user['email']) ?>">
    <button>Сохранить</button>
</form>

<a href="index.php">Назад</a>
