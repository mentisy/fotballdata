<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Utility;

use Avolle\Fotballdata\Utility\Inflector;
use PHPUnit\Framework\TestCase;

/**
 * Test Inflector
 */
class InflectorTest extends TestCase
{
    /**
     * Test singularize method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Utility\Inflector::singularize()
     */
    public function testSingularize(): void
    {
        $this->assertSame('Test', Inflector::singularize('Tests'));
        $this->assertSame('test', Inflector::singularize('tests'));
        $this->assertSame('test', Inflector::singularize('tests')); // For cache check
        $this->assertSame('person', Inflector::singularize('people'));
        $this->assertSame('match', Inflector::singularize('matches'));
        $this->assertSame('pokemon', Inflector::singularize('pokemon'));
        // Matches no inflection rules (covers bottom lines)
        $this->assertSame('absolutegibberish', Inflector::singularize('absolutegibberish'));
    }
}
