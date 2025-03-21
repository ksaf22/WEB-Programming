<?php

$myNum = 1111;
$answer = $myNum;

$answer += 2;
$answer *= 2;
$answer -= 2;
$answer /= 2;

$answer -= $myNum;
echo 'Итоговое значение answer: ', $answer, "\n";