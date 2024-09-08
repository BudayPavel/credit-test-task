<?php

declare(strict_types=1);

namespace App\Model\Company\Constraint\Exist;

use App\Model\Loan\Entity\VO\State;
use App\Service\RandomRejection\RandomRejectionInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class ClientStateValidator extends ConstraintValidator
{
    public function __construct(private readonly RandomRejectionInterface $randomRejection)
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof ClientState) {
            throw new UnexpectedTypeException($constraint, ClientState::class);
        }

        if (!$state = State::tryFrom((int) $value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }

        if ($state->isEqual(State::NY) && $this->randomRejection->rand()) {
            $this->context->buildViolation($constraint->messageForNY)->addViolation();
        }
    }
}
