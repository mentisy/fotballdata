<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Entity;

use Avolle\Fotballdata\Entity\EntityHelperTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test EntityHelperTrait
 */
class EntityHelperTraitTest extends TestCase
{
    use EntityHelperTrait;

    /**
     * Date property that the trait will convert
     *
     * @var string
     */
    protected string $date = '/Date(1650578307030-0000)/';

    /**
     * Date property that contains a value not matching regular expression
     *
     * @var string
     */
    protected string $invalidDate = 'something';

    /**
     * Test toDate method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Entity\EntityHelperTrait::toDate()
     */
    public function testToDate(): void
    {
        $timezone = date_default_timezone_get();
        date_default_timezone_set('Europe/Oslo'); // The API returns all datetimes in this timezone, without changing the timezone suffix
        $this->assertSame('2022-04-21 23:58:27', $this->toDate('date'));
        $this->assertSame('Unknown', $this->toDate('invalidDate'));
        $this->assertSame('Unknown', $this->toDate('not-a-property'));
        date_default_timezone_set($timezone);
    }

    /**
     * Test toNameParts method
     *
     * @return void
     * @uses \Avolle\Fotballdata\Entity\EntityHelperTrait::toNameParts()
     */
    public function testToNameParts(): void
    {
        $name = 'Alexander Filli Bom Bom Bom';

        // Indexed - Default
        [$firstName, $surname] = $this->toNameParts($name);
        $this->assertSame('Alexander Filli Bom Bom', $firstName);
        $this->assertSame('Bom', $surname);

        // Indexed - False
        /** @noinspection PhpRedundantOptionalArgumentInspection */
        [$firstName, $surname] = $this->toNameParts($name, false);
        $this->assertSame('Alexander Filli Bom Bom', $firstName);
        $this->assertSame('Bom', $surname);

        // Indexed - True
        $names = $this->toNameParts($name, true);
        $this->assertArrayHasKey('firstName', $names);
        $this->assertArrayHasKey('surname', $names);
        $this->assertSame('Alexander Filli Bom Bom', $names['firstName']);
        $this->assertSame('Bom', $names['surname']);
    }
}
