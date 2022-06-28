<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\TournamentsEndpoints;
use PHPUnit\Framework\TestCase;

class TournamentsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\TournamentsEndpoints
     */
    protected TournamentsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new TournamentsEndpoints();
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('tournaments/1', $endpoint->getUrl());
    }

    /**
     * Test matches method
     *
     * @return void
     */
    public function testMatches(): void
    {
        $endpoint = $this->endpoint->matches(1);
        $this->assertSame('tournaments/1/matches', $endpoint->getUrl());
    }

    /**
     * Test tables method
     *
     * @return void
     */
    public function testTables(): void
    {
        $endpoint = $this->endpoint->tables(1);
        $this->assertSame('tournaments/1/tables', $endpoint->getUrl());
    }

    /**
     * Test teams method
     *
     * @return void
     */
    public function testTeams(): void
    {
        $endpoint = $this->endpoint->teams(1);
        $this->assertSame('tournaments/1/teams', $endpoint->getUrl());
    }
}
