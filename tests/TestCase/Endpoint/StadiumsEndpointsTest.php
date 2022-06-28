<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\StadiumsEndpoints;
use PHPUnit\Framework\TestCase;

class StadiumsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\StadiumsEndpoints
     */
    protected StadiumsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new StadiumsEndpoints();
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('stadiums/1', $endpoint->getUrl());
    }

    /**
     * Test matches method
     *
     * @return void
     */
    public function testMatches(): void
    {
        $endpoint = $this->endpoint->matches(1);
        $this->assertSame('stadiums/1/matches', $endpoint->getUrl());
    }

    /**
     * Test clubMatches method
     *
     * @return void
     */
    public function testClubMatches(): void
    {
        $endpoint = $this->endpoint->clubMatches(1, 2);
        $this->assertSame('stadiums/1/clubs/2/matches', $endpoint->getUrl());
    }

    /**
     * Test children method
     *
     * @return void
     */
    public function testChildren(): void
    {
        $endpoint = $this->endpoint->children(1);
        $this->assertSame('stadiums/1/children', $endpoint->getUrl());
    }
}
