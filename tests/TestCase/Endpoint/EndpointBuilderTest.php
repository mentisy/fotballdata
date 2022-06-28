<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\EndpointBuilder;
use PHPUnit\Framework\TestCase;

class EndpointBuilderTest extends TestCase
{
    /**
     * Test constructor method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Endpoint\EndpointBuilder::__construct()
     */
    public function testConstructor(): void
    {
        $endpoint = new EndpointBuilder('a-base');
        $this->assertSame('a-base', $endpoint->getUrl());
    }

    /**
     * Test setUrl method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Endpoint\EndpointBuilder::setUrl()
     */
    public function testSetUrl(): void
    {
        $endpoint = new EndpointBuilder('teams/');
        $return = $endpoint->setUrl(1, 'two', 3, 'four');
        $this->assertInstanceOf(EndpointBuilder::class, $return);
        $this->assertSame('teams/1/two/3/four', $endpoint->getUrl());
        $endpoint->setUrl();
        $this->assertSame('teams/', $endpoint->getUrl());
    }

    /**
     * Test getUrl method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Endpoint\EndpointBuilder::getUrl()
     */
    public function testGetUrl(): void
    {
        $endpoint = new EndpointBuilder('tournaments/');
        $endpoint->setUrl(5);
        $this->assertSame('tournaments/5', $endpoint->getUrl());
        $endpoint->setUrl();
        $this->assertSame('tournaments/', $endpoint->getUrl());
    }
}
