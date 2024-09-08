<?php

declare(strict_types=1);

namespace App\Model\Loan\Constraint\IsEligibleForLoan;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class ClientMonthlyIncomeValidator extends ConstraintValidator
{
    public const MIN_INCOME = 1000;

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ClientMonthlyIncome) {
            throw new UnexpectedTypeException($constraint, ClientMonthlyIncome::class);
        }

        if ($value < self::MIN_INCOME) {
            $this->context->buildViolation($constraint->message)
                ->setParameters(['{{ min_income }}' => self::MIN_INCOME])
                ->addViolation();
        }
    }
}
