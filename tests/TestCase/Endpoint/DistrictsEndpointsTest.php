<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\DistrictsEndpoints;
use PHPUnit\Framework\TestCase;

class DistrictsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\DistrictsEndpoints
     */
    protected DistrictsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new DistrictsEndpoints();
    }

    /**
     * Test all method
     *
     * @return void
     */
    public function testAll(): void
    {
        $endpoint = $this->endpoint->all();
        $this->assertSame('districts/', $endpoint->getUrl());
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(999);
        $this->assertSame('districts/999', $endpoint->getUrl());
    }

    /**
     * Test clubs method
     *
     * @return void
     */
    public function testClubs(): void
    {
        $endpoint = $this->endpoint->clubs(1);
        $this->assertSame('districts/1/clubs', $endpoint->getUrl());
    }

    /**
     * Test teams method
     *
     * @return void
     */
    public function testTeams(): void
    {
        $endpoint = $this->endpoint->teams(1);
        $this->assertSame('districts/1/teams', $endpoint->getUrl());
    }

    /**
     * Test tournaments method
     *
     * @return void
     */
    public function testTournaments(): void
    {
        $endpoint = $this->endpoint->tournaments(1);
        $this->assertSame('districts/1/tournaments', $endpoint->getUrl());
    }

    /**
     * Test stadiums method
     *
     * @return void
     */
    public function testStadiums(): void
    {
        $endpoint = $this->endpoint->stadiums(1);
        $this->assertSame('districts/1/stadiums', $endpoint->getUrl());
    }
}
