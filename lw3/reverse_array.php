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

function reverse($array)
{
    if(!empty($array))
    {
        $array = array_combine(range(count($array) - 1, 0), array_values($array));
        ksort($array);
        print_r($array);
    }
    else
    {
        http_response_code(404);
        throw new Exception('Can`t find translation for ' . $word);
    }
}

try
{
    if(count($_GET) != ARG_COUNT)
    {
        http_response_code(400);
        throw new Exception('Usage: <word>:string');
    }

    echo reverse(explode(',', getParamFromGetRequest('arr')));
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