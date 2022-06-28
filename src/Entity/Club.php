<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Club entity
 *
 * @property int $ClubId
 * @property string $ClubName
 * @property int $DistrictId
 * @property \Avolle\Fotballdata\Entity\Game[] $Matches
 * @property \Avolle\Fotballdata\Entity\Team[] $Teams
 * @property \Avolle\Fotballdata\Entity\Tournament[] $Tournaments
 */
class Club extends Entity
{
    /*
     * @inheritdoc
     */
    protected array $aliases = [
        'Match' => 'Game',
    ];
}
