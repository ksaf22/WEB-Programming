<?php

function factorial($n) {
    if ($n <= 1) {
        return 1;
    } else {
        return $n * factorial($n - 1);
    }
}

$str = 'a1b2c3';
$pattern = '/\d+/';

$result = preg_replace_callback(
    $pattern,
    function($matches) {
        $number = intval($matches[0]);
        return factorial($number);
    }, $str);

echo $result;
