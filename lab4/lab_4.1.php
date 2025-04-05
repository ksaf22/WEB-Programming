//6 вариант

<?php
$str = 'f12f fghf f$%f ffff fxrf abba adca';
$pattern = '/f..f/';
preg_match_all($pattern, $str, $matches);
print_r($matches[0]);
