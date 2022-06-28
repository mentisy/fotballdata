<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestClasses;

/**
 * Creates config arrays for use in TestCases
 */
trait TestConfigTrait
{
    /**
     * Create a valid config array
     *
     * @return array
     */
    public function validConfig(): array
    {
        return [
            'clubId' => 1,
            'cid' => 2,
            'cwd' => 'a-pass',
        ];
    }
}
