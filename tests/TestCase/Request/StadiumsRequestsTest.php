<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Stadium;
use Avolle\Fotballdata\Request\StadiumsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/stadiums/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/stadiums/26886/matches?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/stadiums/1034/clubs/997/matches?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
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
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/stadiums/1034/children?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $stadiumsRequests = new StadiumsRequests($this->validConfig());
        $stadium = $stadiumsRequests->children(1034);
        $this->assertInstanceOf(Stadium::class, $stadium);
    }
}
