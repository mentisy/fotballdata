<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Config;

/**
 * Config instance
 */
class Config
{
    /**
     * Config
     *
     * @var array<string, mixed>
     */
    protected array $config = [];

    /**
     * Config constructor
     *
     * @param array<string, mixed> $config Incoming configuration
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Write key to config
     *
     * @param string $key Config key
     * @param mixed $value Config value
     * @return void
     */
    public function write(string $key, $value): void
    {
        $this->config[$key] = $value;
    }

    /**
     * Read key from config
     *
     * @param string|null $key Config key
     * @param mixed $defaultValue Default value to return if key does not exist
     * @return array|mixed|null
     */
    public function read(?string $key = null, $defaultValue = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        return $this->config[$key] ?? $defaultValue;
    }
}
