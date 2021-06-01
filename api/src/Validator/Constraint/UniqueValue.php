<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

use App\Validator\UniqueValueValidator;
use Attribute;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class UniqueValue extends Constraint
{
    public string $entityClass;
    public string $field;
    public string $message = 'This value is already used.';

    public function __construct(
        string $entityClass,
        string $field,
        string $message = null,
    ) {
        parent::__construct();
        $this->entityClass = $entityClass;
        $this->field = $field;
        $this->message = $message ?? $this->message;
    }

    public function validatedBy(): string
    {
        return UniqueValueValidator::class;
    }
}
