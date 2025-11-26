<form action="" method="get">
    <label>Ваше имя:</label><br>
    <input type="text" name="name"><br><br>

    <label>Ваш город:</label><br>
    <input type="text" name="city"><br><br>

    <button type="submit">Отправить</button>
</form>

<?php
if (!empty($_GET['name']) && !empty($_GET['city'])) {
    $name = htmlspecialchars($_GET['name']);
    $city = htmlspecialchars($_GET['city']);

    echo "Привет, $name! Добро пожаловать из города $city.";
}
?>
