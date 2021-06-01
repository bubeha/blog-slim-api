<?php

declare(strict_types=1);

namespace App\Validator;

use App\Validator\Constraint\UniqueValue;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

final class UniqueValueValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $value
     * @throws Exception
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof UniqueValue) {
            throw new UnexpectedTypeException($constraint, UniqueValue::class);
        }

        $entityRepository = $this->entityManager->getRepository($constraint->entityClass);

        $searchResults = $entityRepository->findBy([
            $constraint->field => $value,
        ]);

        if (\count($searchResults) > 0) {
            $this->context->buildViolation($constraint->message)
                ->addViolation()
            ;
        }
    }
}
