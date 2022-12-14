<?php

namespace App\Form\Type;

use App\Validator\Constraints\isRut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DollarValueByMonthType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->add('rut', TextType::class,['constraints'=> new isRut()])
             ->add('email',EmailType::class)
             ->add('Mes', DateType::class,[
                 'widget'=>'choice',
                 'format'=>'yyyy-M-dd',
                 'years' =>range(date('Y'),'1991'),
                 'months'=> range('01',date('n')),
                 'days'=> range('01',date('d'))
                 ])
             ->add('download', SubmitType::class,['label'=>'descargar'])
             ->add('visulize', SubmitType::class,['label'=>'visualizar']);
    }

}