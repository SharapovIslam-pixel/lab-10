<?php

// Проверка простого числа
function isPrime(int $n): bool {
    if ($n < 2) return false;

    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i === 0) return false;
    }
    return true;
}

// Переворот строки
function reverseString(string $str): string {
    return strrev($str);
}

// Среднее значение массива
function average(array $arr): float {
    if (empty($arr)) return 0;
    return array_sum($arr) / count($arr);
}

// Верхний регистр
function convertToUpper(array $arr): array {
    return array_map('strtoupper', $arr);
}

// Квадраты чисел (стрелочная функция)
function squareArray(array $arr): array {
    $square = fn(int $x): int => $x * $x;
    return array_map($square, $arr);
}
