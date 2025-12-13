<?php
require 'calc.php';

$numbers = [1, 2, 3, 4, 5];

echo "<h3>Среднее значение массива</h3>";
echo "Массив: " . implode(", ", $numbers) . "<br>";
echo "Среднее: " . average($numbers);
