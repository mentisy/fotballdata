<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request\Mock;

use Avolle\Fotballdata\Endpoint\ClubsEndpoints;
use Avolle\Fotballdata\Endpoint\DistrictsEndpoints;
use Avolle\Fotballdata\Endpoint\EndpointBuilder;
use Avolle\Fotballdata\Endpoint\MatchesEndpoints;
use Avolle\Fotballdata\Endpoint\SeasonsEndpoints;
use Avolle\Fotballdata\Endpoint\StadiumsEndpoints;
use Avolle\Fotballdata\Endpoint\TeamsEndpoints;
use Avolle\Fotballdata\Endpoint\TournamentsEndpoints;
use Avolle\Fotballdata\Request\ClubsRequests;
use Avolle\Fotballdata\Request\DistrictsRequests;
use Avolle\Fotballdata\Request\MatchesRequests;
use Avolle\Fotballdata\Request\Mock\MockRequest;
use Avolle\Fotballdata\Request\SeasonsRequests;
use Avolle\Fotballdata\Request\StadiumsRequests;
use Avolle\Fotballdata\Request\TeamsRequests;
use Avolle\Fotballdata\Request\TournamentsRequests;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use LogicException;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for MockRequest
 */
class MockRequestTest extends TestCase
{
    use TestConfigTrait;

    /**
     * Test constructor method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::__construct()
     */
    public function testConstructor(): void
    {
        $request = new MatchesRequests($this->validConfig());
        $endpoint = (new MatchesEndpoints())->get(1);
        $query = [];
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $this->assertNotNull($mockRequest->getMethod());
        $this->assertNotNull($mockRequest->getUrl());
        $this->assertNotNull($mockRequest->getResponse());
    }

    /**
     * Test getMethod method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::getMethod()
     */
    public function testGetMethod(): void
    {
        $request = new MatchesRequests($this->validConfig());
        $endpoint = (new MatchesEndpoints())->get(1);
        $query = [];
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $this->assertSame('GET', $mockRequest->getMethod());
    }

    /**
     * Test getUrl method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::getUrl()
     */
    public function testGetUrl(): void
    {
        $request = new MatchesRequests($this->validConfig());
        $endpoint = (new MatchesEndpoints())->get(1);
        $query = [];
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $this->assertSame('https://api.fotballdata.no/v1/matches/1', $mockRequest->getUrl());

        $request = new StadiumsRequests($this->validConfig());
        $endpoint = (new StadiumsEndpoints())->clubMatches(1, 2);
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $this->assertSame('https://api.fotballdata.no/v1/stadiums/1/clubs/2/matches', $mockRequest->getUrl());
    }

    /**
     * Test getResponse method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::getResponse()
     */
    public function testGetResponse(): void
    {
        $request = new MatchesRequests($this->validConfig());
        $endpoint = (new MatchesEndpoints())->get(1);
        $query = [];
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $fileExpected = MockRequest::MOCK_REQUEST_PATH . 'matches/get.json';
        $this->assertJsonStringEqualsJsonFile($fileExpected, $mockRequest->getResponse()->getStringBody());
        $this->assertTrue($mockRequest->getResponse()->hasHeader('Was-Mocked'));
        $this->assertTrue($mockRequest->getResponse()->getHeaderLine('Was-Mocked') === 'true');
    }

    /**
     * Test mockFile method
     * Asserts that all mocked requests map to a valid mock file
     *
     * @param string $file Filename
     * @param string $request Request class
     * @param string $endpoint Endpoint class
     * @param string $method Request and endpoint method
     * @param array<int, string|int>|null ...$args Args to pass to request method
     * @return void
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::mockFile()
     * @dataProvider mockFileMatchesProvider
     */
    public function testMockFile(string $file, string $request, string $endpoint, string $method, ...$args): void
    {
        $request = new $request($this->validConfig());
        $endpoint = new $endpoint->$method(...$args);
        $query = [];
        $mockRequest = new MockRequest($request, $endpoint, $query);
        $this->assertJsonStringEqualsJsonFile(
            MockRequest::MOCK_REQUEST_PATH . $file,
            $mockRequest->getResponse()->getStringBody(),
        );
    }

    /**
     * Test mockFile method
     * Mock file does not match a pattern, so will throw Exception
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\MockFileNotFoundException
     * @uses \Avolle\Fotballdata\Request\Mock\MockRequest::mockFile()
     */
    public function testMockFileInvalidMockFile(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage(sprintf('Could not find mocked response file `%s`.', '/something-invalid'));
        $request = new MatchesRequests($this->validConfig());
        $endpoint = (new EndpointBuilder('/'))->setUrl('something-invalid');
        new MockRequest($request, $endpoint, []);
    }

    /**
     * Provides test data for mockFile method
     *
     * @return array<int, array<int, int|string>>
     * @uses \Avolle\Fotballdata\Test\TestCase\Request\Mock\MockRequestTest::testMockFile()
     */
    public function mockFileMatchesProvider(): array
    {
        return [
            // Clubs
            ['clubs/get.json', ClubsRequests::class, ClubsEndpoints::class, 'get', 1],
            ['clubs/matches.json', ClubsRequests::class, ClubsEndpoints::class, 'matches', 1],
            ['clubs/teams.json', ClubsRequests::class, ClubsEndpoints::class, 'teams', 1],
            ['clubs/tournaments.json', ClubsRequests::class, ClubsEndpoints::class, 'tournaments', 1],
            // Districts
            ['districts/all.json', DistrictsRequests::class, DistrictsEndpoints::class, 'all'],
            ['districts/get.json', DistrictsRequests::class, DistrictsEndpoints::class, 'get', 1],
            ['districts/clubs.json', DistrictsRequests::class, DistrictsEndpoints::class, 'clubs', 1],
            ['districts/teams.json', DistrictsRequests::class, DistrictsEndpoints::class, 'teams', 1],
            ['districts/tournaments.json', DistrictsRequests::class, DistrictsEndpoints::class, 'tournaments', 1],
            ['districts/stadiums.json', DistrictsRequests::class, DistrictsEndpoints::class, 'stadiums', 1],
            // Matches
            ['matches/get.json', MatchesRequests::class, MatchesEndpoints::class, 'get', 1],
            ['matches/people.json', MatchesRequests::class, MatchesEndpoints::class, 'people', 1],
            ['matches/peopleandevents.json', MatchesRequests::class, MatchesEndpoints::class, 'peopleAndEvents', 1],
            // Seasons
            ['seasons/all.json', SeasonsRequests::class, SeasonsEndpoints::class, 'all'],
            ['seasons/get.json', SeasonsRequests::class, SeasonsEndpoints::class, 'get', 1],
            // Stadiums
            ['stadiums/get.json', StadiumsRequests::class, StadiumsEndpoints::class, 'get', 1],
            ['stadiums/matches.json', StadiumsRequests::class, StadiumsEndpoints::class, 'matches', 1],
            ['stadiums/clubs/matches.json', StadiumsRequests::class, StadiumsEndpoints::class, 'clubMatches', 1, 1],
            ['stadiums/children.json', StadiumsRequests::class, StadiumsEndpoints::class, 'children', 1],
            // Teams
            ['teams/get.json', TeamsRequests::class, TeamsEndpoints::class, 'get', 1],
            ['teams/matches.json', TeamsRequests::class, TeamsEndpoints::class, 'matches', 1],
            ['teams/tournaments.json', TeamsRequests::class, TeamsEndpoints::class, 'tournaments', 1],
            ['teams/tables.json', TeamsRequests::class, TeamsEndpoints::class, 'tables', 1],
            ['teams/players.json', TeamsRequests::class, TeamsEndpoints::class, 'players', 1],
            // Tournaments
            ['tournaments/get.json', Tournamentsrequests::class, TournamentsEndpoints::class, 'get', 1],
            ['tournaments/matches.json', Tournamentsrequests::class, TournamentsEndpoints::class, 'matches', 1],
            ['tournaments/tables.json', Tournamentsrequests::class, TournamentsEndpoints::class, 'tables', 1],
            ['tournaments/teams.json', Tournamentsrequests::class, TournamentsEndpoints::class, 'teams', 1],
        ];
    }
}
