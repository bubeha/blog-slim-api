<?php

declare(strict_types=1);

namespace App\Services\FormRequest;

use Symfony\Component\HttpFoundation\Request;

interface FormRequestContract
{
    public function __construct(Request $request);
}
