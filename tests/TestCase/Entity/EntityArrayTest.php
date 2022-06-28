<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\EntityArray;
use Avolle\Fotballdata\Entity\Person;
use PHPUnit\Framework\TestCase;

/**
 * Test EntityArray
 *
 * @uses \Avolle\Fotballdata\Entity\EntityArray
 */
class EntityArrayTest extends TestCase
{
    /**
     * Test constructor and toArray method
     *
     * @return void
     * @throws \Exception
     * @uses \Avolle\Fotballdata\Entity\EntityArray::__construct()
     * @uses \Avolle\Fotballdata\Entity\EntityArray::toArray()
     */
    public function testConstructorAndToArray(): void
    {
        $values = [
            [
                'FirstName' => 'Alexander',
                'SurName' => 'Vollisen',
            ],
            [
                'FirstName' => 'Kåre',
                'SurName' => 'Heddeng',
            ],
        ];
        $entity = new EntityArray('Person', $values);
        $entityValues = $entity->toArray();
        $personOne = new Person($values[0]);
        $personTwo = new Person($values[1]);
        $this->assertEquals($personOne, $entityValues[0]);
        $this->assertEquals($personTwo, $entityValues[1]);
    }
}
