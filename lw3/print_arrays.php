<?php

header('Content-Type: text/plain');
$simpleNumArray = [2, 3, 5, 7, 11, 13, 17, 19, 23, 29];
$funcInfo = array(
        'count' => 'Подсчитывает количество элементов массива.',
        'is_array' => 'Определяет, является ли переменная массивом.',
        'array_merge' => 'Сливает один или большее количество массивов.',
        'empty' => 'Проверяет, пуста ли переменная.',
        'print_r' => 'Выводит удобочитаемую информацию о переменной.'
);
$matrix = array_fill(0, 4, array_fill(0, 4, 1));

print_r($simpleNumArray);
print_r($funcInfo);
print_r($matrix);