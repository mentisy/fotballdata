<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Season;
use Avolle\Fotballdata\Request\SeasonsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for SeasonsRequests
 */
class SeasonsRequestsTest extends TestCase
{
    use FakeResponseTrait;
    use TestConfigTrait;

    /**
     * Test all method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\SeasonsRequests::all()
     */
    public function testAll(): void
    {
        $seasonsRequests = new SeasonsRequests($this->validConfig());
        $seasons = $seasonsRequests->all();
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertTrue(is_array($seasons));
    }

    /**
     * Test get method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\SeasonsRequests::get()
     */
    public function testGet(): void
    {
        $seasonsRequests = new SeasonsRequests($this->validConfig());
        $season = $seasonsRequests->get(1);
        $this->assertInstanceOf(Season::class, $season);
    }
}
