<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

use App\Validator\UniqueValueValidator;
use Attribute;
use Exception;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
final class UniqueValue extends Constraint
{
    /** @var class-string */
    public string $entityClass;
    public string $field;
    public string $message = 'This value is already used.';

    /**
     * @throws Exception
     */
    public function __construct(
        string $entityClass,
        string $field,
        string $message = null,
    ) {
        if (!class_exists($entityClass)) {
            throw new Exception('The Entity Class should be a class.');
        }

        $this->entityClass = $entityClass;
        $this->field = $field;
        $this->message = $message ?? $this->message;

        parent::__construct();
    }

    public function validatedBy(): string
    {
        return UniqueValueValidator::class;
    }
}
