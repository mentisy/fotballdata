<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\Person;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    /**
     * Test toRoleName method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Entity\Person::toRoleName()
     */
    public function testToRoleName(): void
    {
        $person = new Person();
        $this->assertSame('Unknown', $person->toRoleName());
        $person->RoleId = 999;
        $this->assertSame('Unknown', $person->toRoleName());
        $person->RoleId = 3;
        $this->assertSame('Trener', $person->toRoleName());
    }
}
