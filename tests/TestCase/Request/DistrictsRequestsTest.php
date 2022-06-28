<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\District;
use Avolle\Fotballdata\Request\DistrictsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for DistrictsRequests
 */
class DistrictsRequestsTest extends TestCase
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
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::all()
     */
    public function testAll(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default_array.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $districts = $districtsRequests->all();
        /** @noinspection PhpConditionAlreadyCheckedInspection */
        $this->assertTrue(is_array($districts));
    }

    /**
     * Test get method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::get()
     */
    public function testGet(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $district = $districtsRequests->get(1);
        $this->assertInstanceOf(District::class, $district);
    }

    /**
     * Test clubs method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::clubs()
     */
    public function testClubs(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/26886/clubs?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $district = $districtsRequests->clubs(26886);
        $this->assertInstanceOf(District::class, $district);
    }

    /**
     * Test teams method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::teams()
     */
    public function testTeams(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/26886/teams?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $district = $districtsRequests->teams(26886);
        $this->assertInstanceOf(District::class, $district);
    }

    /**
     * Test tournaments method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::tournaments()
     */
    public function testTournaments(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/26886/tournaments?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $district = $districtsRequests->tournaments(26886);
        $this->assertInstanceOf(District::class, $district);
    }

    /**
     * Test stadiums method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\DistrictsRequests::stadiums()
     */
    public function testStadiums(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/26886/stadiums?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('default.json'),
        );
        $districtsRequests = new DistrictsRequests($this->validConfig());
        $district = $districtsRequests->stadiums(26886);
        $this->assertInstanceOf(District::class, $district);
    }
}
