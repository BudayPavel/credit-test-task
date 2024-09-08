<?php

declare(strict_types=1);

namespace App\Model\Loan\Constraint\IsEligibleForLoan;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class ClientFicoScoreValidator extends ConstraintValidator
{
    public const MIN_FICO = 500;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ClientFicoScore) {
            throw new UnexpectedTypeException($constraint, ClientFicoScore::class);
        }

        if ($value < self::MIN_FICO) {
            $this->context->buildViolation($constraint->message)
                ->setParameters(['{{ min_fico }}' => self::MIN_FICO])
                ->addViolation();
        }
    }
}
