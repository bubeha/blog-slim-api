<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ValidationException extends RuntimeException
{
    private ConstraintViolationListInterface $errors;

    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;

        parent::__construct('Validation Exception');
    }

    /**
     * @return array<array-key, non-empty-list<string>>
     */
    public function getMessages(): array
    {
        $messages = [];

        foreach ($this->errors as $error) {
            $messages[$error->getPropertyPath()][] = (string)$error->getMessage();
        }

        return $messages;
    }
}
