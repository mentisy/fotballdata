<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Stadium;
use Avolle\Fotballdata\Request\StadiumsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for StadiumsRequests
 */
class StadiumsRequestsTest extends TestCase
{
    use FakeResponseTrait;
    use TestConfigTrait;

    /**
     * Test get method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\StadiumsRequests::get()
     */
    public function testGet(): void
    {
        $stadiumsRequests = new StadiumsRequests($this->validConfig());
        $stadium = $stadiumsRequests->get(1);
        $this->assertInstanceOf(Stadium::class, $stadium);
    }

    /**
     * Test matches method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\StadiumsRequests::matches()
     */
    public function testMatches(): void
    {
        $stadiumsRequests = new StadiumsRequests($this->validConfig());
        $stadium = $stadiumsRequests->matches(26886);
        $this->assertInstanceOf(Stadium::class, $stadium);
    }

    /**
     * Test clubMatches method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\StadiumsRequests::clubMatches()
     */
    public function testClubMatches(): void
    {
        $stadiumsRequests = new StadiumsRequests($this->validConfig());
        $stadium = $stadiumsRequests->clubMatches(1034, 997);
        $this->assertInstanceOf(Stadium::class, $stadium);
    }

    /**
     * Test children method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\StadiumsRequests::children()
     */
    public function testChildren(): void
    {
        $stadiumsRequests = new StadiumsRequests($this->validConfig());
        $stadiumChildren = $stadiumsRequests->children(1034);
        $this->assertIsArray($stadiumChildren);
        $firstStadium = $stadiumChildren[0];
        $this->assertInstanceOf(Stadium::class, $firstStadium);
    }
}
