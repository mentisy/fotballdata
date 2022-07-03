<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Tournament entity
 *
 * @property int $TournamentId
 * @property string $TournamentName
 * @property int $AgeCategoryId
 * @property int $DistrictId
 * @property int $Division
 * @property int $GenderId
 * @property int $Group
 * @property int $HalfTimeBreakInMin
 * @property string $LastChangedDate
 * @property int $MatchPeriodDurationInMin
 * @property int $NumberOfMatchPeriods
 * @property int $NumberOfPromotedTeams
 * @property int $NumberOfRelegatedTeams
 * @property int $NumberOfTeams
 * @property int $NumberOfTeamsQualifiedForPromotion
 * @property int $NumberOfTeamsQualifiedForRelegation
 * @property string $PitchSizeName
 * @property int $PlayersOnField
 * @property string $PlayFormName
 * @property bool $PublishResult
 * @property bool $PublishTournamentTable
 * @property bool $PushChanges
 * @property int $SeasonId
 * @property string $StartDateFirstTournamentRound
 * @property int $TournamentAgeCategory
 * @property string $TournamentNumber
 * @property int $TournamentStatusId
 * @property int $TournamentTypeId
 * @property \Avolle\Fotballdata\Entity\TournamentTableTeam[] $TournamentTableTeams
 * @property \Avolle\Fotballdata\Entity\Game[] $Matches
 * @property \Avolle\Fotballdata\Entity\Team[] $Teams
 */
class Tournament extends Entity
{
    use EntityHelperTrait;

    /*
     * @inheritdoc
     */
    protected array $aliases = [
        'Match' => 'Game',
    ];
}
