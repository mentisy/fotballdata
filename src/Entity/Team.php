<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Team entity
 *
 * @property int $TeamId
 * @property string $TeamName
 * @property int $AgeCategoryId
 * @property string $AgeCategoryName
 * @property int $GenderId
 * @property string $GenderName
 * @property int $ClubId
 * @property string $ClubName
 * @property \Avolle\Fotballdata\Entity\Game[] $Matches
 * @property \Avolle\Fotballdata\Entity\Person[] $Persons
 * @property \Avolle\Fotballdata\Entity\Player[] $Players
 * @property \Avolle\Fotballdata\Entity\Tournament[] $Tournaments
 */
class Team extends Entity
{
    /*
     * @inheritdoc
     */
    protected array $aliases = [
        'Match' => 'Game',
    ];
}
