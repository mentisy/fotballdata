<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\EndpointInterface;
use Avolle\Fotballdata\Test\TestClasses\AbstractedBaseEndpoint;
use PHPUnit\Framework\TestCase;

class BaseEndpointTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Test\TestClasses\AbstractedBaseEndpoint
     */
    protected AbstractedBaseEndpoint $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new AbstractedBaseEndpoint();
    }

    /**
     * Test createEndpoint method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Endpoint\BaseEndpoint::createEndpoint()
     */
    public function testCreateEndpoint(): void
    {
        $endpoint = $this->endpoint->createTestEndpoint();
        $this->assertInstanceOf(EndpointInterface::class, $endpoint);
        $this->assertSame('teams/', $endpoint->getUrl());

        $endpoint = $this->endpoint->createTestEndpoint('matches', 1);
        $this->assertSame('teams/matches/1', $endpoint->getUrl());
    }
}
