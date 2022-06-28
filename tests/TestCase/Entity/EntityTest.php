<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\Club;
use Avolle\Fotballdata\Entity\Entity;
use Avolle\Fotballdata\Entity\Game;
use Avolle\Fotballdata\Entity\Person;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Test Entity
 *
 * @uses \Avolle\Fotballdata\Entity\Entity
 */
class EntityTest extends TestCase
{
    /**
     * Test constructor method
     * Just simple property setters
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::__construct()
     */
    public function testConstructorSimple(): void
    {
        $properties = [
            'FirstName' => 'Alexander',
            'SurName' => 'Vollisen',
        ];
        $person = new Person($properties);
        $this->assertSame('Alexander', $person->FirstName);
        $this->assertSame('Vollisen', $person->SurName);
    }

    /**
     * Test constructor method
     * With object value
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::__construct()
     */
    public function testConstructorWithObjectValue(): void
    {
        $team = new stdClass();
        $team->TeamId = 1;
        $team->TeamName = 'A team';
        $properties = [
            'ClubId' => 1,
            'Team' => $team,
        ];
        $club = new Club($properties);
        $this->assertSame(1, $club->ClubId);
        /** @noinspection PhpUndefinedFieldInspection Fake property so we can test setting an object property value */
        $clubTeamOne = $club->Team;
        $this->assertSame(1, $clubTeamOne->TeamId);
        $this->assertSame('A team', $clubTeamOne->TeamName);
    }

    /**
     * Test constructor method
     * With array values
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::__construct()
     */
    public function testConstructorWithArrayValue(): void
    {
        $teamOne = new stdClass();
        $teamOne->TeamId = 1;
        $teamOne->TeamName = 'A team';

        $teamTwo = new stdClass();
        $teamTwo->TeamId = 2;
        $teamTwo->TeamName = 'Another team';
        $properties = [
            'ClubId' => 1,
            'Teams' => [$teamOne, $teamTwo],
        ];
        $club = new Club($properties);
        $this->assertSame(1, $club->ClubId);
        $this->assertTrue(is_array($club->Teams));
        $clubTeamOne = $club->Teams[0];
        $this->assertSame(1, $clubTeamOne->TeamId);
        $this->assertSame('A team', $clubTeamOne->TeamName);
        $clubTeamTwo = $club->Teams[1];
        $this->assertSame(2, $clubTeamTwo->TeamId);
        $this->assertSame('Another team', $clubTeamTwo->TeamName);
    }

    /**
     * Test constructor method
     * With entity that has a hasMany relationship values
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::__construct()
     */
    public function testConstructorWithHasManyRelationship(): void
    {
        $eventOne = new stdClass();
        $eventOne->MatchEventId = 500;
        $eventOne->PlayerName = "A Player name";
        $eventTwo = new stdClass();
        $eventTwo->MatchEventId = 600;
        $eventTwo->PlayerName = "Another Player name";
        $matchEventList = [
            $eventOne,
            $eventTwo,
        ];
        $match = new Game([
            'HomeTeamId' => 99,
            'MatchEventList' => $matchEventList,
        ]);
        $this->assertSame(99, $match->HomeTeamId);
        $this->assertTrue(is_array($match->MatchEventList));
        $matchEventOne = $match->MatchEventList[0];
        $this->assertSame(500, $matchEventOne->MatchEventId);
        $this->assertSame('A Player name', $matchEventOne->PlayerName);
        $matchEventTwo = $match->MatchEventList[1];
        $this->assertSame(600, $matchEventTwo->MatchEventId);
        $this->assertSame('Another Player name', $matchEventTwo->PlayerName);
    }

    /**
     * Test get method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::get()
     */
    public function testGet(): void
    {
        $entity = new Entity(['test' => 'A test']);
        $this->assertSame('A test', $entity->get('test'));
    }

    /**
     * Test set method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\Entity::set()
     */
    public function testSet(): void
    {
        $entity = new Entity();
        $entity->set('test', 'A test');
        $this->assertSame('A test', $entity->get('test'));
    }
}
