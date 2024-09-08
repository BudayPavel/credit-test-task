<?php

declare(strict_types=1);

namespace App\Exception;

use Exception;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends Exception
{
    private readonly array $violationList;

    public function __construct(ConstraintViolationListInterface $violationList)
    {
        $errors = [];

        /** @var ConstraintViolation $violation */
        foreach ($violationList as $violation) {
            $errors['errors'][] = [
                'property' => $violation->getPropertyPath(),
                'message' => $violation->getMessage()
            ];
        }

        $this->violationList = $errors;

        parent::__construct(json_encode($errors, JSON_THROW_ON_ERROR));
    }

    public function getViolationList(): array
    {
        return $this->violationList;
    }
}
