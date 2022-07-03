<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Match entity
 *
 * This entity should be called `Match`, but `match` is a protected control structure token for PHP >=8.0.
 * It is therefore aliased to `Game` to avoid this collision.
 *
 * @property int $MatchId
 * @property string $MatchNumber
 * @property int $AwayTeamClubId
 * @property string $AwayTeamContactPersonEmail
 * @property bool $AwayTeamContactPersonInfoHidden
 * @property string $AwayTeamContactPersonMobilePhone
 * @property string $AwayTeamContactPersonName
 * @property int $AwayTeamGoals
 * @property int $AwayTeamId
 * @property string $AwayTeamName
 * @property bool $Cancelled
 * @property bool $FinalResultApprovedByDistrict
 * @property bool $FinalResultApprovedByReferee
 * @property int $HomeTeamClubId
 * @property string $HomeTeamContactPersonEmail
 * @property bool $HomeTeamContactPersonInfoHidden
 * @property string $HomeTeamContactPersonMobilePhone
 * @property string $HomeTeamContactPersonName
 * @property int $HomeTeamGoals
 * @property int $HomeTeamId
 * @property string $HomeTeamName
 * @property bool $Interrupted
 * @property string $LastChangedDate
 * @property string $MatchStartDate
 * @property int $MatchTotalTime
 * @property bool $Postponed
 * @property string $RefereeEmail
 * @property string $RefereeMobilePhone
 * @property bool $RefereePersonInfoHidden
 * @property int $RefereeClub
 * @property int $RefereeClubId
 * @property int $RefereeId
 * @property string $RefereeName
 * @property int $RefereeNumber
 * @property int $SeasonId
 * @property int $Spectators
 * @property int $StadiumId
 * @property string $StadiumName
 * @property int $TournamentId
 * @property string $TournamentName
 * @property int $TournamentRoundNumber
 * @property bool $WalkOverAway
 * @property bool $WalkOverBoth
 * @property bool $WalkOverHome
 * @property \Avolle\Fotballdata\Entity\Player[] $AwayTeamPlayers
 * @property \Avolle\Fotballdata\Entity\Player[] $HomeTeamPlayers
 * @property \Avolle\Fotballdata\Entity\MatchEvent[] $MatchEventList
 * @property \Avolle\Fotballdata\Entity\Referee[] $Referees
 */
class Game extends Entity
{
    use EntityHelperTrait;

    /**
     * @inheritdoc
     */
    protected array $hasMany = [
        'MatchEventList' => 'MatchEvent',
    ];

    /**
     * @inheritdoc
     */
    protected array $aliases = [
        'AwayTeamPlayer' => 'Player',
        'HomeTeamPlayer' => 'Player',
    ];

    /**
     * Compiles the home team information into a Team entity
     * Contact information is not compiled as it is not part of the Team entity
     *
     * @throws \Exception
     */
    public function homeTeam(): Team
    {
        return $this->toTeam(true);
    }

    /**
     * Compiles the away team information into a Team entity
     * Contact information is not compiled as it is not part of the Team entity
     *
     * @throws \Exception
     */
    public function awayTeam(): Team
    {
        return $this->toTeam(false);
    }

    /**
     * Get referee info in match as Referee entity
     * When calling matches/get, you get the referee as a collection of properties in this entity.
     * When calling matches/people, you get the referees as an array in the $Referees property
     *
     * @return \Avolle\Fotballdata\Entity\Referee
     * @throws \Exception
     */
    public function referee(): Referee
    {
        [$firstName, $surname] = $this->toNameParts($this->RefereeName);

        return new Referee([
            'Email' => $this->RefereeEmail,
            'MobilePhone' => $this->RefereeMobilePhone,
            'PersonInfoHidden' => $this->RefereePersonInfoHidden,
            'RefereeClub' => $this->RefereeClub,
            'RefereeClubId' => $this->RefereeClubId,
            'RefereeId' => $this->RefereeId,
            'FirstName' => $firstName,
            'SurName' => $surname,
            'RefereeNumber' => $this->RefereeNumber,
        ]);
    }

    /**
     * Did your team win the match
     *
     * @param int $yourTeamId The teamId for your team
     * @return bool
     */
    public function won(int $yourTeamId): bool
    {
        if ($this->isHome($yourTeamId)) {
            return $this->HomeTeamGoals > $this->AwayTeamGoals;
        }

        return $this->AwayTeamGoals > $this->HomeTeamGoals;
    }

    /**
     * Did the game end up a draw
     *
     * @return bool
     */
    public function draw(): bool
    {
        return $this->HomeTeamGoals === $this->AwayTeamGoals;
    }

    /**
     * Did your team lose the match
     *
     * @param int $yourTeamId The teamId for your team
     * @return bool
     */
    public function lost(int $yourTeamId): bool
    {
        if ($this->isHome($yourTeamId)) {
            return $this->HomeTeamGoals < $this->AwayTeamGoals;
        }

        return $this->AwayTeamGoals < $this->HomeTeamGoals;
    }

    /**
     * Is your team at home. Is tested against the `Fotballdata` configuration `clubId`
     *
     * @param int $yourTeamId The teamId for your team
     * @return bool
     */
    public function isHome(int $yourTeamId): bool
    {
        return $yourTeamId === $this->HomeTeamId;
    }

    /**
     * Is match in the future
     *
     * @return bool
     */
    public function isFuture(): bool
    {
        $matchTime = $this->toDate('MatchStartDate');
        $matchTime = strtotime($matchTime);
        $now = time();

        return $now < $matchTime;
    }

    /**
     * Is match in the past
     *
     * @return bool
     */
    public function isPast(): bool
    {
        return !$this->isFuture();
    }

    /**
     * Compiles team information into a Team entity. If $home is true, returns home team's information.
     * Otherwise, returns away team
     *
     * @param bool $home Whether to compile the home team or the away team
     * @return \Avolle\Fotballdata\Entity\Team
     * @throws \Exception
     */
    protected function toTeam(bool $home): Team
    {
        [$FirstName, $SurName] = $this->toNameParts(
            $home
                ? $this->HomeTeamContactPersonName
                : $this->AwayTeamContactPersonName
        );
        $MobilePhone = $home ? $this->HomeTeamContactPersonMobilePhone : $this->AwayTeamContactPersonMobilePhone;
        $Email = $home ? $this->HomeTeamContactPersonEmail : $this->AwayTeamContactPersonEmail;
        $PersonInfoHidden = $home ? $this->HomeTeamContactPersonInfoHidden : $this->AwayTeamContactPersonInfoHidden;

        $person = new Person(compact('FirstName', 'SurName', 'MobilePhone', 'Email', 'PersonInfoHidden'));

        $ClubId = $home ? $this->HomeTeamClubId : $this->AwayTeamClubId;
        $TeamId = $home ? $this->HomeTeamId : $this->AwayTeamId;
        $TeamName = $home ? $this->HomeTeamName : $this->AwayTeamName;
        $Persons = [$person];

        return new Team(compact('ClubId', 'TeamId', 'TeamName', 'Persons'));
    }
}
