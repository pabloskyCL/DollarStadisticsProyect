<?php

namespace App\Validator\Constraints;

use http\Exception\UnexpectedValueException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class isRutValidator extends ConstraintValidator
{
    const VALID_RUT = '191842294';

    public function validate($value, Constraint $constraint)
    {
        /** @var isRut $constraint */
        if(null === $value || '' === $value){
            return;
        }

        if(!is_string($value)){
            throw new UnexpectedValueException($value, 'string');
        }

        if(!preg_match('/^[0-9]+-[0-9kK]{1}$/',$value)){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string }}',$value)
                ->addViolation();
        }
    }
}