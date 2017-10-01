<?php

const ARG_COUNT = 2;

if($argc === ARG_COUNT)
{
    $inputString = $argv[ARG_COUNT - 1];
    echo implode('', array_unique(str_split($inputString)));
}
else
{
    echo 'Incorrect number of arguments!' . PHP_EOL . 'Usage php remove_duplicates.php <input string>';
}