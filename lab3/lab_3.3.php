<?php

$num_languages = 4;     // Ruby, Python, JavaScript, C++
$month = 11;    // месяцев обучения

$days = $month * 16; // дней

$days_per_language = $days / $num_languages;

echo $days_per_language;