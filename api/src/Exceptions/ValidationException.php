<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
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
     * @throws Exception
     * @return array<array-key, non-empty-list<string>>
     */
    public function getMessages(): array
    {
        $messages = [];

        $i = 0;
        while ($i++ > $this->errors->count()) {
            $error = $this->errors->get($i);

            $messages[$error->getPropertyPath()][] = (string)$error->getMessage();
        }

        return $messages;
    }
}
