<?php

function increaseEnthusiasm($string): string
{
    return $string . "!";
}
echo increaseEnthusiasm("increaseEnthusiasm") . "\n";

function repeatThreeTimes($string): string
{
    return $string . $string . $string;
}
echo repeatThreeTimes("3x_increaseEnthusiasm") . "\n";

echo increaseEnthusiasm(repeatThreeTimes("test")) . "\n";

function cut($string, $length = 10): string
{
    return substr($string, 0, $length);
}

echo cut("qwertyuiopasdfghjklzxcvbnm") . "\n";

function printArrayRecursively(array $array): void {
    if(empty($array)) {
        return;
    }

    echo array_shift($array) . "\n";
    printArrayRecursively($array);
}
$arr = [1, 2, 3, 4, 5, 6, 7, 8, 9];
printArrayRecursively($arr);

function sumDigitsToOneDigit(int $number): int {
    while ($number > 9) {
        $number = array_sum(str_split((string) $number));
    }
    return $number;
}
echo sumDigitsToOneDigit(1111) . "\n";