<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\Referee;
use PHPUnit\Framework\TestCase;

class RefereeTest extends TestCase
{
    /**
     * Test fullName method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Entity\Referee::fullName()
     */
    public function testFullName(): void
    {
        $referee = new Referee();
        $referee->FirstName = 'Alexander Filli';
        $referee->SurName = 'Bom Bom Bom';
        $this->assertSame('Alexander Filli Bom Bom Bom', $referee->fullName());
    }
}
