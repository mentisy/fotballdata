<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Endpoint;

use Avolle\Fotballdata\Endpoint\MatchesEndpoints;
use PHPUnit\Framework\TestCase;

class MatchesEndpointsTest extends TestCase
{
    /**
     * Test Subject
     *
     * @var \Avolle\Fotballdata\Endpoint\MatchesEndpoints
     */
    protected MatchesEndpoints $endpoint;

    /**
     * @inheritdoc
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->endpoint = new MatchesEndpoints();
    }

    /**
     * Test get method
     *
     * @return void
     */
    public function testGet(): void
    {
        $endpoint = $this->endpoint->get(1);
        $this->assertSame('matches/1', $endpoint->getUrl());
    }

    /**
     * Test people method
     *
     * @return void
     */
    public function testPeople(): void
    {
        $endpoint = $this->endpoint->people(1);
        $this->assertSame('matches/1/people', $endpoint->getUrl());
    }

    /**
     * Test peopleAndEvents method
     *
     * @return void
     */
    public function testPeopleAndEvents(): void
    {
        $endpoint = $this->endpoint->peopleAndEvents(1);
        $this->assertSame('matches/1/peopleandevents', $endpoint->getUrl());
    }
}
