<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Player entity
 *
 * @property int $PersonId
 * @property int $PlayerId
 * @property string $FirstName
 * @property string $SurName
 * @property bool $PersonInfoHidden
 * @property int $PlayerShirtNumber
 * @property int $PositionId
 * @property string $Position
 * @property bool $TeamCaptain
 * @property int $SortOrder
 */
class Player extends Entity
{
}
