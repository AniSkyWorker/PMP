<?php
header('Content-Type: text/html');

const ARG_COUNT = 1;
const TRANSLATIONS = array(
    'Keyboard' => 'Клавиатура',
    'Keypad' => 'Клавиатура',
    'Good' => 'Хороший',
    'Bad' => 'Плохой',
    'Ugly' => 'Злой',
);

function getParamFromGetRequest($arg_name)
{
    if(isset($_GET[$arg_name]))
    {
        return $_GET[$arg_name];
    }
    
    throw new InvalidArgumentException($arg_name);
}

function translate($word)
{
    $translation = array_key_exists($word, TRANSLATIONS) ? TRANSLATIONS[$word]
     : array_keys(TRANSLATIONS, $word);
    if(!empty($translation))
    {
        if(is_array($translation))
        {
            $translation = $translation[0];
        }
        echo $translation;
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

    echo translate(getParamFromGetRequest('word'));
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