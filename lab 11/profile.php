<?php
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "Гость";
$city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : "неизвестного города";

echo "Привет, $name! Добро пожаловать из города $city.";

if (!empty($_SERVER['HTTP_REFERER'])) {
    echo "<br><br><a href='{$_SERVER['HTTP_REFERER']}'>Вернуться назад</a>";
}
