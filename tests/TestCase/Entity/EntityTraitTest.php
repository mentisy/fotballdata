<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\EntityTrait;
use Avolle\Fotballdata\Entity\Game;
use Avolle\Fotballdata\Entity\Person;
use Avolle\Fotballdata\Entity\Player;
use Avolle\Fotballdata\Exception\EntityClassNotFoundException;
use PHPUnit\Framework\TestCase;

class EntityTraitTest extends TestCase
{
    use EntityTrait;

    /**
     * Aliases
     *
     * @var array<string, string>
     */
    protected array $aliases;

    /**
     * Test entityClassName method
     * No aliases or hasMany defined
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\EntityTrait::entityClassName()
     */
    public function testEntityClassNameNoAliases(): void
    {
        $this->assertSame(Game::class, $this->entityClassName('Games'));
        $this->assertSame(Person::class, $this->entityClassName('People'));
        $this->expectException(EntityClassNotFoundException::class);
        $this->expectExceptionMessage('Could not find entity `Avolle\Fotballdata\Entity\Test`.');
        $this->entityClassName('Tests');
    }

    /**
     * Test entityClassName method
     * Aliases defined
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\EntityTrait::entityClassName()
     */
    public function testEntityClassNameHasMany(): void
    {
        $this->aliases = [
            'AwayTeamPlayer' => 'Player',
            'HomeTeamPlayer' => 'Player',
            'SomethingElse' => 'NotAClass',
        ];
        $this->assertSame(Player::class, $this->entityClassName('AwayTeamPlayer'));
        $this->assertSame(Player::class, $this->entityClassName('HomeTeamPlayer'));
        $this->expectException(EntityClassNotFoundException::class);
        $this->expectExceptionMessage('Could not find entity `Avolle\Fotballdata\Entity\NoPerson`.');
        $this->entityClassName('NoPeople');
    }
}
