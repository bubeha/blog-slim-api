<?php

declare(strict_types=1);

namespace Tests\Unit\Config;

use App\Services\Config\Config;
use App\Services\Config\ConfigInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigTest.
 *
 * @internal
 * @covers \App\Services\Config\Config
 */
final class ConfigTest extends TestCase
{
    public function testDefaultValue(): void
    {
        $config = $this->getConfig();
        $defaultValue = 'value';

        self::assertSame(
            $config->get('key', $defaultValue),
            $defaultValue,
        );
    }

    public function testIncorrectDefaultValue(): void
    {
        $config = $this->getConfig();

        self::assertNotSame(
            'incorrect',
            $config->get('key', 'correct')
        );
    }

    public function testConfigValue(): void
    {
        $data = $this->getTestedValue();

        $config = $this->getConfig($data);

        self::assertSame('value', $config->get('key'));
    }

    public function testAllConfig(): void
    {
        $data = $this->getTestedValue();

        $config = $this->getConfig($data);

        self::assertSame(
            $data,
            $config->all()
        );
    }

    /**
     * @param array<string,mixed> $default
     *
     * @return Config
     */
    private function getConfig(array $default = []): ConfigInterface
    {
        return new Config($default);
    }

    /**
     * @return array<string, string>
     */
    private function getTestedValue(): array
    {
        return [
            'key' => 'value',
        ];
    }
}
