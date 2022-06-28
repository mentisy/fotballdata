<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\TeamsEndpoints;
use PHPUnit\Framework\TestCase;

class TeamsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\TeamsEndpoints
     */
    protected TeamsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new TeamsEndpoints();
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('teams/1', $endpoint->getUrl());
    }

    /**
     * Test matches method
     *
     * @return void
     */
    public function testMatches(): void
    {
        $endpoint = $this->endpoint->matches(1);
        $this->assertSame('teams/1/matches', $endpoint->getUrl());
    }

    /**
     * Test tournaments method
     *
     * @return void
     */
    public function testTournaments(): void
    {
        $endpoint = $this->endpoint->tournaments(1);
        $this->assertSame('teams/1/tournaments', $endpoint->getUrl());
    }

    /**
     * Test tables method
     *
     * @return void
     */
    public function testTables(): void
    {
        $endpoint = $this->endpoint->tables(1);
        $this->assertSame('teams/1/tables', $endpoint->getUrl());
    }

    /**
     * Test players method
     *
     * @return void
     */
    public function testPlayers(): void
    {
        $endpoint = $this->endpoint->players(1);
        $this->assertSame('teams/1/players', $endpoint->getUrl());
    }
}
