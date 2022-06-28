<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Club;
use Avolle\Fotballdata\Request\ClubsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/26886?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/26886/matches?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/26886/teams?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/26886/tournaments?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $clubsRequests = new ClubsRequests($this->validConfig());
        $club = $clubsRequests->tournaments(26886);
        $this->assertInstanceOf(Club::class, $club);
    }
}
