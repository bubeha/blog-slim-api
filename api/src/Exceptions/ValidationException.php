<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends RuntimeException
{
    public function __construct(private ConstraintViolationListInterface $errors)
    {
        parent::__construct('Validation Exception');
    }

    public function getMessages(): array
    {
        $messages = [];

        foreach ($this->errors as $error) {
            $messages[$error->getPropertyPath()][] = $error->getMessage();
        }

        return $messages;
    }
}