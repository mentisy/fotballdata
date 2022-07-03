<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\Player;
use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase
{
    /**
     * Test fullName method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Entity\Player::fullName()
     */
    public function testFullName(): void
    {
        $player = new Player();
        $player->FirstName = 'Alexander Filli';
        $player->SurName = 'Bom Bom Bom';
        $this->assertSame('Alexander Filli Bom Bom Bom', $player->fullName());
    }
}
