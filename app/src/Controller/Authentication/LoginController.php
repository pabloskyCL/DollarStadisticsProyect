<?php

namespace App\Controller\Authentication;

use App\Form\Type\Login\LoginUserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class LoginController extends AbstractController{


    /**
     * @Route("/login", name="app_login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils,TranslatorInterface $translator): Response
    {
        $error = null;
        if($authenticationUtils->getLastAuthenticationError()){
            $error = $translator->trans('invalid credentials.');
        }

        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login.html.twig',['last_username'=>$lastUsername,'error'=>$error]);

    }

}