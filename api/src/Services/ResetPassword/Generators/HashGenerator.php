<?php

declare(strict_types=1);

namespace App\Services\ResetPassword\Generators;

use Exception;

final class HashGenerator implements Generator
{
    /**
     * @throws Exception
     */
    public function generate(int $length = 16): string
    {
        $string = '';

        while (($len = \strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}
