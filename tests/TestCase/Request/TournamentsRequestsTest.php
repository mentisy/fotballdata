<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Tournament;
use Avolle\Fotballdata\Request\TournamentsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for TournamentsRequests
 */
class TournamentsRequestsTest extends TestCase
{
    use FakeResponseTrait;
    use TestConfigTrait;

    /**
     * Test get method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TournamentsRequests::get()
     */
    public function testGet(): void
    {
        $tournamentsRequests = new TournamentsRequests($this->validConfig());
        $tournament = $tournamentsRequests->get(1);
        $this->assertInstanceOf(Tournament::class, $tournament);
    }

    /**
     * Test matches method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TournamentsRequests::matches()
     */
    public function testMatches(): void
    {
        $tournamentsRequests = new TournamentsRequests($this->validConfig());
        $tournament = $tournamentsRequests->matches(26886);
        $this->assertInstanceOf(Tournament::class, $tournament);
    }

    /**
     * Test tables method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TournamentsRequests::tables()
     */
    public function testTables(): void
    {
        $tournamentsRequests = new TournamentsRequests($this->validConfig());
        $tournament = $tournamentsRequests->tables(26886);
        $this->assertInstanceOf(Tournament::class, $tournament);
    }

    /**
     * Test teams method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TournamentsRequests::teams()
     */
    public function testTeams(): void
    {
        $teamsRequests = new TournamentsRequests($this->validConfig());
        $team = $teamsRequests->teams(26886);
        $this->assertInstanceOf(Tournament::class, $team);
    }
}
