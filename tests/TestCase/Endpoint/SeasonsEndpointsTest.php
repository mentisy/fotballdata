<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\SeasonsEndpoints;
use PHPUnit\Framework\TestCase;

class SeasonsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\SeasonsEndpoints
     */
    protected SeasonsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new SeasonsEndpoints();
    }

    /**
     * Test all method
     *
     * @return void
     */
    public function testAll(): void
    {
        $endpoint = $this->endpoint->all();
        $this->assertSame('seasons/', $endpoint->getUrl());
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('seasons/1', $endpoint->getUrl());
    }
}
