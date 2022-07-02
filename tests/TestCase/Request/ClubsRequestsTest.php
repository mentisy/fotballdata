<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Club;
use Avolle\Fotballdata\Request\ClubsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for ClubsRequests
 */
class ClubsRequestsTest extends TestCase
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
     * @uses \Avolle\Fotballdata\Request\ClubsRequests::get()
     */
    public function testGet(): void
    {
        $clubsRequests = new ClubsRequests($this->validConfig());
        $club = $clubsRequests->get(26886);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test matches method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\ClubsRequests::matches()
     */
    public function testMatches(): void
    {
        $clubsRequests = new ClubsRequests($this->validConfig());
        $club = $clubsRequests->matches(26886);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test teams method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\ClubsRequests::teams()
     */
    public function testTeams(): void
    {
        $clubsRequests = new ClubsRequests($this->validConfig());
        $club = $clubsRequests->teams(26886);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test teams method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\ClubsRequests::tournaments()
     */
    public function testTournaments(): void
    {
        $clubsRequests = new ClubsRequests($this->validConfig());
        $club = $clubsRequests->tournaments(26886);
        $this->assertInstanceOf(Club::class, $club);
    }
}
