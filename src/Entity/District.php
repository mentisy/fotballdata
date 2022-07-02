<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * District entity
 *
 * @property int $DistrictId
 * @property string $DistrictName
 * @property \Avolle\Fotballdata\Entity\Club[] $Clubs
 * @property \Avolle\Fotballdata\Entity\Team[] $Teams
 * @property \Avolle\Fotballdata\Entity\Tournament[] $Tournaments
 * @property \Avolle\Fotballdata\Entity\Stadium[] $Stadiums
 */
class District extends Entity
{
}
