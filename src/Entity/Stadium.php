<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Stadium entity
 *
 * @property int $StadiumId
 * @property string $StadiumName
 * @property string $SurfaceName
 * @property int $DistrictId
 * @property string $Latitude
 * @property string $Longitude
 * @property string $LastChangedDate
 * @property int $StadiumParentId
 * @property string $StadiumParentName
 * @property int $StadiumType
 * @property \Avolle\Fotballdata\Entity\Game[] $Matches
 */
class Stadium extends Entity
{
    use EntityHelperTrait;

    /*
     * @inheritdoc
     */
    protected array $aliases = [
        'Match' => 'Game',
    ];
}
