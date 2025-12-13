<?php
require 'calc.php';

$words = ["php", "mysql", "linux", "apache"];

echo "<h3>Массив строк в верхнем регистре</h3>";
echo "Исходный массив:<br>";
print_r($words);

echo "<br><br>Результат:<br>";
print_r(convertToUpper($words));
