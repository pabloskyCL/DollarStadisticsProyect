<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class isRut extends Constraint {

    public string $message = 'El rut no esta en formato requerido {{ string }}';

    public function validatedBy(): string
    {
        return \get_class($this).'Validator';
    }


}