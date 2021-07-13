<?php

declare(strict_types=1);

namespace App\Services\FormRequest;

use App\Exceptions\ValidationException;
use Exception;
use ReflectionClass;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class FormRequest implements ArgumentValueResolverInterface
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @throws Exception
     */
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $type = (string)$argument->getType();

        if (!class_exists($type)) {
            throw new Exception('test');
        }

        return (new ReflectionClass($type))->implementsInterface(FormRequestContract::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $class = (string)$argument->getType();

        if (!class_exists($class)) {
            throw new RuntimeException('test');
        }

        /** @psalm-suppress MixedMethodCall */
        $form = new $class($request);

        $errors = $this->validator->validate($form);

        if (0 !== \count($errors)) {
            throw new ValidationException($errors);
        }

        yield $class;
    }
}
