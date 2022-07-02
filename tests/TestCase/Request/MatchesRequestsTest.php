<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Game;
use Avolle\Fotballdata\Request\MatchesRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for MatchesRequests
 */
class MatchesRequestsTest extends TestCase
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
     * @uses \Avolle\Fotballdata\Request\MatchesRequests::get()
     */
    public function testGet(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/matches/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('matches/get.json'),
        );
        $matchesRequests = new MatchesRequests($this->validConfig());
        $match = $matchesRequests->get(1);
        $this->assertInstanceOf(Game::class, $match);
        $this->assertFalse($match->WalkOverHome);
    }

    /**
     * Test people method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\MatchesRequests::people()
     */
    public function testPeople(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/matches/26886/people?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('matches/people.json'),
        );
        $matchesRequests = new MatchesRequests($this->validConfig());
        $match = $matchesRequests->people(26886);
        $this->assertInstanceOf(Game::class, $match);
    }

    /**
     * Test peopleAndEvents method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\MatchesRequests::peopleAndEvents()
     */
    public function testPeopleAndEvents(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/matches/26886/peopleandevents?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('matches/peopleandevents.json'),
        );
        $matchesRequests = new MatchesRequests($this->validConfig());
        $match = $matchesRequests->peopleAndEvents(26886);
        $this->assertInstanceOf(Game::class, $match);
    }
}
