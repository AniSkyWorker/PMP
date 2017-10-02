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

function swap($arr, $p1, $p2)
{
    $temp = $arr[$p2];
    $arr[$p2] = $arr[$p1];
    $arr[$p1] = $temp;
    return $arr;
}

function bubble($arr)
{
    $count = count($arr);
    for ($j = 1; $j < $count; $j++)
    {
        for ($i=1; $i < $count-$j+1; $i++)
        {
            if ($arr[$i-1] > $arr[$i])
            {
                $arr = swap($arr, $i-1, $i);
            }
        }
    }
    return $arr;
}

function sortArray($array)
{
    if(!empty($array))
    {
       return bubble($array);
    }
}

try
{
    if(count($_GET) != ARG_COUNT)
    {
        http_response_code(400);
        throw new Exception('Usage: <numbers>:number,number');
    }

    echo implode(',', sortArray(explode(',', getParamFromGetRequest('numbers'))));
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