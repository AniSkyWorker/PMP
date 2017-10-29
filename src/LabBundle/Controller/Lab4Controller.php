<?php

namespace LabBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class Lab4Controller extends Controller
{
    /**
    * @Route("/remove_extra_blanks")
    * @Method({"GET"})
    */
    function removeExtraBlanks(Request $request)
    {
        $text = $request->get('text');
        return new Response(preg_replace('/\s+/', ' ', $text));
    }

    /**
    * @Route("/password_strength")
    * @Method({"GET"})
    */
    function countPasswordStrength(Request $request)
    {
        $password = $request->get('password');
        $passwordLenght = strlen($password);

        if($passwordLenght > 0) {
            $digitsCount = preg_match_all('/[0-9]/', $password);
            $upperSymCount = preg_match_all( "/[A-Z]/", $password);
            $lowerSymCount = preg_match_all( "/[a-z]/", $password);
            
            $allSignCount = $digitsCount + $upperSymCount + $lowerSymCount;

            if ($passwordLenght === $allSignCount) {
                $safety = 4 * $allSignCount
                + 4 * $digitsCount
                - ($allSignCount - strlen(count_chars($password, 3)) + 1);
                
                if($upperSymCount > 0) {
                    $safety += ($passwordLenght - $upperSymCount) * 2;
                }

                if($lowerSymCount > 0) {
                    $safety += ($passwordLenght - $lowerSymCount) * 2;
                }

                if($upperSymCount + $lowerSymCount === $allSignCount
                    || $digitsCount === $allSignCount) {
                    $safety -= $allSignCount;
                }

                return new Response(json_encode(array('strength' => $safety)));
            }
        }
        return new Response('Password must contains latinic symbols and digits!');
    }
}
