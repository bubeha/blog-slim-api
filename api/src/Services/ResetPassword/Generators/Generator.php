<?php

declare(strict_types=1);

namespace App\Services\ResetPassword\Generators;

interface Generator
{
    public function generate(int $length = 16): string;
}
