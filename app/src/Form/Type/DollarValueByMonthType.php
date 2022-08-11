<?php

namespace App\Form\Type;

use App\Validator\Constraints\isRut;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DollarValueByMonthType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
         $builder
             ->add('rut', TextType::class,['constraints'=> new isRut()])
             ->add('email',EmailType::class)
             ->add('Mes', DateType::class,[
                 'widget'=>'choice',
                 'years' =>range('1991',date('Y')),
                 'months'=> range('01',date('m')),
                 'days'=> range('01',date('d'))
                 ])
             ->add('download', SubmitType::class,['label'=>'descargar'])
             ->add('visulize', SubmitType::class,['label'=>'visualizar']);
    }


}