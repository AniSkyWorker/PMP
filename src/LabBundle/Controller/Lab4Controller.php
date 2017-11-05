<?php

namespace LabBundle\Controller;

use LabBundle\Utils\PasswordStrengthCalculator;
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
    function calcPasswordStrength(Request $request)
    {
        $passwordUtils = new PasswordStrengthCalculator();
        $password = $request->get('password');
        $passwordLenght = strlen($password);

        if($passwordLenght > 0 && $passwordUtils->isPasswordCorrect($password)) {
            $safety = $passwordUtils->getCountStrength($password)
                    + $passwordUtils->getUpperSymStrength($password)
                    + $passwordUtils->getLowerSymStrength($password)
                    - $passwordUtils->countRepeats($password)
            ;

            if($passwordUtils->isOnlyDigits($password) || $passwordUtils->isOnlySym($password)) {
                $safety -= $passwordLenght;
            }
            return new Response(json_encode(array('strength' => $safety)));
        }
        return new Response('Password must contains latinic symbols and digits!');
    }
}
