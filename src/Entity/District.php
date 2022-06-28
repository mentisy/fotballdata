<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * District entity
 *
 * @property int $DistrictId
 * @property string $DistrictName
 * @property \Avolle\Fotballdata\Entity\Club[] $clubs
 * @property \Avolle\Fotballdata\Entity\Game[] $Matches
 * @property \Avolle\Fotballdata\Entity\Team[] $Teams
 * @property \Avolle\Fotballdata\Entity\Tournament[] $Tournaments
 */
class District extends Entity
{
    /*
     * @inheritdoc
     */
    protected array $aliases = [
        'Match' => 'Game',
    ];
}
