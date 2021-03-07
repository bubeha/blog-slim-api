<?php

declare(strict_types=1);

namespace Tests\Unit\Config;

use App\Services\Config\Config;
use App\Services\Config\IConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigTest
 * @package Tests\Unit\Config
 */
final class ConfigTest extends TestCase
{
    /**
     * @return void
     */
    public function testDefaultValue(): void
    {
        $config = $this->getConfig();
        $defaultValue = 'value';

        self::assertEquals(
            $config->get('key', $defaultValue),
            $defaultValue,
        );
    }

    /**
     * @param array<string,mixed> $default
     *
     * @return Config
     */
    private function getConfig(array $default = []): IConfig
    {
        return new Config($default);
    }

    /**
     * @return void
     */
    public function testIncorrectDefaultValue(): void
    {
        $config = $this->getConfig();

        self::assertNotEquals(
            'incorrect',
            $config->get('key', 'correct')
        );
    }

    /**
     * @return void
     */
    public function testConfigValue(): void
    {
        $data = $this->getTestedValue();

        $config = $this->getConfig($data);

        self::assertEquals('value', $config->get('key'));
    }

    /**
     * @return void
     */
    public function testAllConfig(): void
    {
        $data = $this->getTestedValue();

        $config = $this->getConfig($data);

        self::assertEquals(
            $data,
            $config->all()
        );
    }

    /**
     * @return string[]
     */
    private function getTestedValue(): array
    {
        return [
            'key' => 'value',
        ];
    }
}
