<?php

function isSumGreaterThanTen($number1, $number2): int|float
{
    return ($number1 + $number2) > 10;
}
echo isSumGreaterThanTen(3, 8);

function areNumbersEqual($number1, $number2)
{
    return $number1 === $number2;
}
echo areNumbersEqual(4, 4), "\n";

$test = 0;
echo ($test == 0) ? 'верно' : '', "\n";

$age = 13;
if ($age < 10 || $age > 99) {
    echo "Число меньше 10 или больше 99\n";
} else {
    $sum = array_sum(str_split((string)$age));
    if ($sum <= 9) {
        echo "Сумма однозначна\n";
    } else {
        echo "Сумма двузначна\n";
    }
}

$arr = [1, 2, 3];
if (count($arr) == 3) {
    echo "Сумма элементов массива: " . array_sum($arr) . "\n";
}