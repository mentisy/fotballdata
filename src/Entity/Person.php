<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Entity;

/**
 * Person entity
 *
 * @property string $Email
 * @property string $FirstName
 * @property string $MobilePhone
 * @property int $PersonId
 * @property bool $PersonInfoHidden
 * @property int $RoleId
 * @property string $RoleName
 * @property string $SurName
 */
class Person extends Entity
{
    public const ROLES = [
        1 => 'Ass.Lagleder',
        3 => 'Trener',
        4 => 'Kontaktperson',
        6 => 'Materialforvalter',
        7 => 'Keepertrener',
        8 => 'Lege',
        9 => 'Ass.trener',
        15 => 'Fysioterapaut',
        19 => 'Tiltaksleder',
        20 => 'Adm. Leder',
        21 => 'Foreldrekontakt',
        22 => 'Dugnadsansvarlig',
        23 => 'Inkluderingsansvarlig',
    ];

    public function toRoleName(): string
    {
        if (!isset($this->RoleId, self::ROLES[$this->RoleId])) {
            return 'Unknown';
        }

        return self::ROLES[$this->RoleId];
    }
}
