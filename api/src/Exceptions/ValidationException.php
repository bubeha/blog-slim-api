<?php

declare(strict_types=1);

namespace App\Exceptions;

use RuntimeException;

final class ValidationException extends RuntimeException
{
    /** @var non-empty-list<\Symfony\Component\Validator\ConstraintViolationInterface> */
    private array $errors;

    /**
     * ValidationException constructor.
     * @param non-empty-list<\Symfony\Component\Validator\ConstraintViolationInterface> $errors
     */
    public function __construct(array $errors)
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
