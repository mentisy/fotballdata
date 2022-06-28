<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\ClubsEndpoints;
use PHPUnit\Framework\TestCase;

class ClubsEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\ClubsEndpoints
     */
    protected ClubsEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new ClubsEndpoints();
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('clubs/1', $endpoint->getUrl());
    }

    /**
     * Test matches method
     *
     * @return void
     */
    public function testMatches(): void
    {
        $endpoint = $this->endpoint->matches(1);
        $this->assertSame('clubs/1/matches', $endpoint->getUrl());
    }

    /**
     * Test teams method
     *
     * @return void
     */
    public function testTeams(): void
    {
        $endpoint = $this->endpoint->teams(1);
        $this->assertSame('clubs/1/teams', $endpoint->getUrl());
    }

    /**
     * Test tournaments method
     *
     * @return void
     */
    public function testTournaments(): void
    {
        $endpoint = $this->endpoint->tournaments(1);
        $this->assertSame('clubs/1/tournaments', $endpoint->getUrl());
    }
}
