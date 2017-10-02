<?php

header('Content-Type: text/html');

const ARG_COUNT = 1;

function getParamFromGetRequest($arg_name)
{
    if(isset($_GET[$arg_name]))
    {
        return $_GET[$arg_name];
    }
    
    throw new InvalidArgumentException($arg_name);
}

try
{
    if(count($_GET) != ARG_COUNT)
    {
        http_response_code(400);
        throw new Exception('Usage: <stirng>:string');
    }

    print_r(array_count_values(str_split(strtolower(getParamFromGetRequest('string')))));
}
catch (InvalidArgumentException $e)
{
    http_response_code(400);
    echo 'Ошибка, не передан аргумент ' . $e->getMessage() . '.';
}
catch (Exception $e)
{
    echo $e->getMessage();
}