<?php

declare(strict_types=1);

namespace App\Service\Validator;

use App\Exception\ValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator implements ValidationInterface
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    public function validate(object $object): void
    {
        $violations = $this->validator->validate($object);
        if ($violations->count() > 0) {
            throw new ValidationException($violations);
        }
    }
}
