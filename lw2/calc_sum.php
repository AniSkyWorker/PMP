<?php
header('Content-Type: text/html');

const ARG_COUNT = 3;

function GetParamFromGetRequest($arg_name)
{
    if(isset($_GET[$arg_name]))
    {
        return $_GET[$arg_name];
    }
    
    throw new InvalidArgumentException($arg_name);
}

function GetNumberFromGetRequest($arg_name)
{
    $number = GetParamFromGetRequest($arg_name);
    if(is_numeric($number))
    {
        return intval($number);
    }
    throw new UnexpectedValueException($arg_name);
}

function CalculateResult($operationType, $firstNumber, $secondNumber)
{
    switch($operationType)
    {
    case "add":
        return $firstNumber + $secondNumber;
    case "sub":
        return $firstNumber - $secondNumber;
    case "mul":
        return $firstNumber * $secondNumber;
        break;
    case "div":
        if($secondNumber === 0)
        {
            throw new Exception("На ноль делить нельзя!");
        }
        return $firstNumber / $secondNumber;
    default:
        throw new UnexpectedValueException('operation');
    }
}

try
{
    if(count($_GET) > ARG_COUNT)
    {
        throw new Exception('Usage: arg1 agr2 operation<br>arg1,arg2:numbers operation(add/mul/div/sub)');
    }

    echo CalculateResult(GetParamFromGetRequest('operation')
                ,GetNumberFromGetRequest('arg1')
                ,GetNumberFromGetRequest('arg2'));
}
catch (InvalidArgumentException $e)
{
    echo 'Ошибка, не передан аргумент ' . $e->getMessage() . '.';
}
catch (UnexpectedValueException $e)
{
    echo 'Аргумент ' . $e->getMessage() . ' имеет неккоректное значение.';
}
catch (Exception $e)
{
    echo $e->getMessage();
}