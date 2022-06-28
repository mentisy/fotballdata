<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Person;
use Avolle\Fotballdata\Entity\Team;
use Avolle\Fotballdata\Request\TeamsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for TeamsRequests
 */
class TeamsRequestsTest extends TestCase
{
    use FakeResponseTrait;
    use TestConfigTrait;

    /**
     * Test get method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TeamsRequests::get()
     */
    public function testGet(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/teams/26886?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('teams/get.json'),
        );
        $teamsRequest = new TeamsRequests($this->validConfig());
        $team = $teamsRequest->get(26886);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertSame(26886, $team->TeamId);
        $this->assertSame('A Team Senior A', $team->TeamName);
        $this->assertSame(997, $team->ClubId);
        $this->assertCount(4, $team->Persons);
        $this->assertInstanceOf(Person::class, $team->Persons[0]);
        $this->assertSame('Alexander', $team->Persons[0]->FirstName);
        $this->assertFalse($team->Persons[0]->PersonInfoHidden);
    }

    /**
     * Test matches method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Request\TeamsRequests::matches()
     */
    public function testMatches(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/teams/30000/matches?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('teams/matches.json'),
        );
        $teamsRequest = new TeamsRequests($this->validConfig());
        $team = $teamsRequest->matches(30000);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertSame(30000, $team->TeamId);
        $this->assertSame('A Team Senior A', $team->TeamName);
        $this->assertSame(1000, $team->ClubId);
        $this->assertCount(2, $team->Matches);
        $this->assertSame('5. div. menn', $team->Matches[0]->TournamentName);
        $this->assertSame(5, $team->Matches[0]->HomeTeamGoals);
        $this->assertSame(6, $team->Matches[0]->AwayTeamGoals);
        $this->assertFalse($team->Matches[0]->Cancelled);
        $this->assertSame('A Team Senior A', $team->Matches[1]->HomeTeamName);
        $this->assertSame('Even Another Senior A', $team->Matches[1]->AwayTeamName);
        $this->assertSame(3, $team->Matches[1]->HomeTeamGoals);
        $this->assertSame(2, $team->Matches[1]->AwayTeamGoals);
        $this->assertFalse($team->Matches[1]->Cancelled);
    }

    /**
     * Test tournaments method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Request\TeamsRequests::tournaments()
     */
    public function testTournaments(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/teams/30000/tournaments?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('teams/tournaments.json'),
        );
        $teamsRequest = new TeamsRequests($this->validConfig());
        $team = $teamsRequest->tournaments(30000);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertIsArray($team->Tournaments);
        $this->assertSame('5. div. menn', $team->Tournaments[0]->TournamentName);
    }

    /**
     * Test players method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Request\TeamsRequests::players()
     */
    public function testPlayers(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/teams/30000/players?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('teams/players.json'),
        );
        $teamsRequest = new TeamsRequests($this->validConfig());
        $team = $teamsRequest->players(30000);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertCount(0, $team->Players);
    }
}
