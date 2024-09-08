<?php

declare(strict_types=1);

namespace App\Model\Company\Constraint\Exist;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class ClientAgeValidator extends ConstraintValidator
{
    public const MIN_AGE = 18;
    public const MAX_AGE = 60;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ClientAge) {
            throw new UnexpectedTypeException($constraint, ClientAge::class);
        }

        if ($value > self::MAX_AGE || $value < self::MIN_AGE) {
            $this->context->buildViolation($constraint->message)
                ->setParameters(['{{ min_age }}' => self::MIN_AGE, '{{ max_age }}' => self::MAX_AGE])
                ->addViolation();
        }
    }
}
