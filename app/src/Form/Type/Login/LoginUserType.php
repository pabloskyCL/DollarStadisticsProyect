<?php


namespace App\Form\Type\Login;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginUserType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('_username',EmailType::class,['attr'=>['class'=>'form-control','label'=>'Email']])
            ->add('_password',PasswordType::class,['attr'=>['class'=>'form-control','label'=>'contraseña']])
            ->add('logIn',SubmitType::class,['attr'=>['class'=>'btn btn-primary']]);
    }

}