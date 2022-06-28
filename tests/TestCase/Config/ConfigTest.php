<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Config;

use Avolle\Fotballdata\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * Config instance
     *
     * @var \Avolle\Fotballdata\Config\Config
     */
    protected Config $config;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->config = new Config([
            'host' => 'a-host',
            'cid' => 123,
            'cwd' => 456,
            'clubId' => 789,
            'arrayKey' => [
                'a key' => 'something',
                'else',
            ],
        ]);
    }

    /**
     * Test read method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Config\Config::read()
     */
    public function testRead(): void
    {
        $this->assertSame('a-host', $this->config->read('host'));
        $this->assertSame(123, $this->config->read('cid'));
        $this->assertSame(456, $this->config->read('cwd'));
        $this->assertSame(789, $this->config->read('clubId'));
        $expected = [
            'a key' => 'something',
            'else',
        ];
        $this->assertSame($expected, $this->config->read('arrayKey'));

        $this->assertSame(null, $this->config->read('not-a-key'));
        $this->assertSame('default', $this->config->read('not-a-key', 'default'));

        // Read all
        $expected = [
            'host' => 'a-host',
            'cid' => 123,
            'cwd' => 456,
            'clubId' => 789,
            'arrayKey' => [
                'a key' => 'something',
                'else',
            ],
        ];
        $this->assertSame($expected, $this->config->read());
    }

    /**
     * Test write method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Config\Config::write()
     */
    public function testWrite(): void
    {
        $this->assertNull($this->config->read('not-a-key'));
        $this->config->write('not-a-key', true);
        $this->assertTrue($this->config->read('not-a-key'));

        $write = ['something', 'else' => true];
        $this->config->write('a-key', $write);
        $this->assertSame($write, $this->config->read('a-key'));
    }
}
