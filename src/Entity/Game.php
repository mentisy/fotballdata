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
 */
class Game extends Entity
{
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
}
