<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\Game;
use Avolle\Fotballdata\Entity\Person;
use Avolle\Fotballdata\Entity\Referee;
use Avolle\Fotballdata\Entity\Team;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    /**
     * Test referee method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::referee()
     */
    public function testReferee(): void
    {
        $game = new Game([
            'RefereeEmail' => 'person@example.org',
            'RefereeMobilePhone' => '99999999',
            'RefereePersonInfoHidden' => false,
            'RefereeClub' => 'Godøy IL - Fotball',
            'RefereeClubId' => 1054,
            'RefereeId' => 465,
            'RefereeName' => 'Svein Helge Person',
            'RefereeNumber' => 554,
        ]);
        $referee = $game->referee();
        $this->assertSame('person@example.org', $referee->Email);
        $this->assertSame('99999999', $referee->MobilePhone);
        $this->assertSame(false, $referee->PersonInfoHidden);
        $this->assertSame('Godøy IL - Fotball', $referee->RefereeClub);
        $this->assertSame(1054, $referee->RefereeClubId);
        $this->assertSame(465, $referee->RefereeId);
        $this->assertSame('Svein Helge', $referee->FirstName);
        $this->assertSame('Person', $referee->SurName);
        $this->assertSame(554, $referee->RefereeNumber);
        $this->assertInstanceOf(Referee::class, $referee);
    }

    /**
     * Test homeTeam method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::homeTeam()
     */
    public function testHomeTeam(): void
    {
        $game = new Game([
            'HomeTeamClubId' => 1062,
            'HomeTeamId' => 28275,
            'HomeTeamName' => 'Ravn',
            'HomeTeamContactPersonEmail' => 'jorn@example.org',
            'HomeTeamContactPersonInfoHidden' => false,
            'HomeTeamContactPersonMobilePhone' => '99999999',
            'HomeTeamContactPersonName' => 'Jørn Kåre Flåte Kåresen',
        ]);
        $team = $game->homeTeam();
        $this->assertInstanceOf(Team::class, $team);
        $this->assertSame(1062, $team->ClubId);
        $this->assertSame(28275, $team->TeamId);
        $this->assertSame('Ravn', $team->TeamName);

        $this->assertInstanceOf(Person::class, $team->Persons[0]);
        $person = $team->Persons[0];
        $this->assertSame('jorn@example.org', $person->Email);
        $this->assertSame(false, $person->PersonInfoHidden);
        $this->assertSame('99999999', $person->MobilePhone);
        $this->assertSame('Jørn Kåre Flåte', $person->FirstName);
        $this->assertSame('Kåresen', $person->SurName);
    }

    /**
     * Test awayTeam method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::homeTeam()
     */
    public function testAwayTeam(): void
    {
        $game = new Game([
            'AwayTeamClubId' => 1062,
            'AwayTeamId' => 28275,
            'AwayTeamName' => 'Ravn',
            'AwayTeamContactPersonEmail' => 'jorn@example.org',
            'AwayTeamContactPersonInfoHidden' => false,
            'AwayTeamContactPersonMobilePhone' => '99999999',
            'AwayTeamContactPersonName' => 'Jørn Kåre Flåte Kåresen',
        ]);
        $team = $game->awayTeam();
        $this->assertInstanceOf(Team::class, $team);
        $this->assertSame(1062, $team->ClubId);

        $this->assertInstanceOf(Person::class, $team->Persons[0]);
        $person = $team->Persons[0];
        $this->assertSame('Jørn Kåre Flåte', $person->FirstName);
        $this->assertSame('Kåresen', $person->SurName);
    }

    /**
     * Test won method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::won()
     */
    public function testWon(): void
    {
        $teamId = 1;
        $game = new Game(['HomeTeamId' => $teamId]);

        // Home Win
        $game->HomeTeamGoals = 2;
        $game->AwayTeamGoals = 1;
        $this->assertTrue($game->won($teamId));

        // Home Draw
        $game->HomeTeamGoals = 1;
        $this->assertFalse($game->won($teamId));

        // Home Loss
        $game->HomeTeamGoals = 0;
        $this->assertFalse($game->won($teamId));

        $game->HomeTeamId = 2;
        $game->AwayTeamId = $teamId;
        // Away Win
        $game->HomeTeamGoals = 1;
        $game->AwayTeamGoals = 2;
        $this->assertTrue($game->won($teamId));

        // Away Draw
        $game->AwayTeamGoals = 1;
        $this->assertFalse($game->won($teamId));

        // Away Loss
        $game->AwayTeamGoals = 0;
        $this->assertFalse($game->won($teamId));
    }

    /**
     * Test draw method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::draw()
     */
    public function testDraw(): void
    {
        $game = new Game([
            'HomeTeamGoals' => 2,
            'AwayTeamGoals' => 2,
        ]);
        $this->assertTrue($game->draw());

        $game->HomeTeamGoals = 1;
        $this->assertFalse($game->draw());
    }

    /**
     * Test lost method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::lost()
     */
    public function testLost(): void
    {
        $teamId = 1;
        $game = new Game(['HomeTeamId' => $teamId]);

        // Home Win
        $game->HomeTeamGoals = 2;
        $game->AwayTeamGoals = 1;
        $this->assertFalse($game->lost($teamId));

        // Home Draw
        $game->HomeTeamGoals = 1;
        $this->assertFalse($game->lost($teamId));

        // Home Loss
        $game->HomeTeamGoals = 0;
        $this->assertTrue($game->lost($teamId));

        $game->HomeTeamId = 2;
        $game->AwayTeamId = $teamId;
        // Away Win
        $game->HomeTeamGoals = 1;
        $game->AwayTeamGoals = 2;
        $this->assertFalse($game->lost($teamId));

        // Away Draw
        $game->AwayTeamGoals = 1;
        $this->assertFalse($game->lost($teamId));

        // Away Loss
        $game->AwayTeamGoals = 0;
        $this->assertTrue($game->lost($teamId));
    }

    /**
     * Test isFuture method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::isFuture()
     */
    public function testIsFuture(): void
    {
        $game = new Game(['MatchStartDate' => '/Date(1650565800000-0000)/']);
        $this->assertFalse($game->isFuture());
        $game->MatchStartDate = '/Date(9720005976000-0000)/';
        $this->assertTrue($game->isFuture());
    }

    /**
     * Test isPast method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Game::isPast()
     */
    public function testIsPast(): void
    {
        $game = new Game(['MatchStartDate' => '/Date(1650565800000-0000)/']);
        $this->assertTrue($game->isPast());
        $game->MatchStartDate = '/Date(9720005976000-0000)/';
        $this->assertFalse($game->isPast());
    }
}
