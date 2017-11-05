<?php

namespace LabBundle\Utils;

function countUpperSym($text)
{
    return preg_match_all( "/[A-Z]/", $text);
}

function countLowerSym($text)
{
    return preg_match_all( "/[a-z]/", $text);
}

function countDigits($text)
{
    return preg_match_all('/[0-9]/', $text);
}

class PasswordStrengthCalculator
{
    function countRepeats($password)
    {
        return array_sum(array_values(array_filter(count_chars($password, 1), function($v, $k) {
            return $v > 1;
        }, ARRAY_FILTER_USE_BOTH)));
    }

    public function getCountStrength($password)
    {
        return 4 * (strlen($password) + countDigits($password));
    }

    function getUpperSymStrength($password)
    {
        $upperSymCount = countUpperSym($password);
        if($upperSymCount > 0) {
            return (strlen($password) - $upperSymCount) * 2;
        }
        return 0;
    }

    function getLowerSymStrength($password)
    {
        $lowerSymCount = countLowerSym($password);
        if($lowerSymCount > 0) {
            return (strlen($password) - $lowerSymCount) * 2;
        }
        return 0;
    }
    
    function isOnlyDigits($password)
    {
        return strlen($password) === countDigits($password);
    }

    function isOnlySym($password)
    {
        return strlen($password) === (countLowerSym($password) + countUpperSym($password));
    }

    function isPasswordCorrect($password)
    {
        return count(count_chars($password, 1)) === strlen($password);
    }

}