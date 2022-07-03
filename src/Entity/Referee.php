<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Referee entity
 *
 * @property int $PersonId
 * @property int $RefereeId
 * @property string $FirstName
 * @property string $SurName
 * @property bool $PersonInfoHidden
 * @property int $RefereeTypeId
 * @property string $RefereeType
 * @property string $Email
 * @property string $MobilePhone
 * @property int $RefereeClubId
 * @property string $RefereeClub
 * @property int $RefereeNumber
 */
class Referee extends Entity
{
    /**
     * Get the referee's full name
     *
     * @return string
     */
    public function fullName(): string
    {
        return $this->FirstName . ' ' . $this->SurName;
    }
}
