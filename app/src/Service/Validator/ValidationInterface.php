<?php

declare(strict_types=1);

namespace App\Service\Validator;

interface ValidationInterface
{
    public function validate(object $object): void;
}
