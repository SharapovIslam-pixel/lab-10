<?php
require 'calc.php';

$number = 29;

echo "<h3>Проверка простого числа</h3>";
echo $number . " — " . (isPrime($number) ? "простое число" : "составное число");
