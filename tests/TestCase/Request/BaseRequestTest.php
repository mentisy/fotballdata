<?php

declare(strict_types=1);

namespace Avolle\Fotballdata\Test\TestCase\Request;

use Avolle\Fotballdata\Entity\Club;
use Avolle\Fotballdata\Entity\District;
use Avolle\Fotballdata\Entity\ResponseStatus;
use Avolle\Fotballdata\Entity\Stadium;
use Avolle\Fotballdata\Exception\InvalidConfigException;
use Avolle\Fotballdata\Exception\InvalidResponseException;
use Avolle\Fotballdata\Request\ClubsRequests;
use Avolle\Fotballdata\Request\DistrictsRequests;
use Avolle\Fotballdata\Request\MatchesRequests;
use Avolle\Fotballdata\Request\StadiumsRequests;
use Avolle\Fotballdata\Request\TeamsRequests;
use Avolle\Fotballdata\Test\TestClasses\FakeResponseTrait;
use Avolle\Fotballdata\Test\TestClasses\TestConfigTrait;
use Cake\Http\Client;
use PHPUnit\Framework\TestCase;

/**
 * Test Case for BaseRequest
 */
class BaseRequestTest extends TestCase
{
    use FakeResponseTrait;
    use TestConfigTrait;

    /**
     * Test constructor method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::__construct()
     */
    public function testConstructor(): void
    {
        $request = new TeamsRequests($this->validConfig());
        $defaultConfig = [
            'debug' => false,
            'host' => 'api.fotballdata.no/v1',
            'clubId' => 1,
            'cid' => 2,
            'cwd' => 'a-pass',
        ];
        $this->assertSame($defaultConfig, $request->config->read());

        $expectedPartiallyOverwritten = [
            'debug' => false,
            'host' => 'http://localhost',
            'clubId' => 1,
            'cid' => 2,
            'cwd' => 'a-pass',
        ];
        $request = new TeamsRequests($this->validConfig() + ['host' => 'http://localhost']);
        $this->assertSame($expectedPartiallyOverwritten, $request->config->read());

        $confiCompletelyOverwritten = [
            'debug' => false,
            'host' => 'anotherhost.no',
        ] + $this->validConfig();
        $request = new TeamsRequests($confiCompletelyOverwritten);
        $this->assertSame($confiCompletelyOverwritten, $request->config->read());
    }

    /**
     * Test constructor method
     * Response contains an array that should be converted to an array of entities
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::convertResponse()
     */
    public function testConstructorWithResponseArray(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/districts/?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('districts/all.json'),
        );
        $request = new DistrictsRequests($this->validConfig());
        $this->assertSame('District', $request->entityName);
        $match = $request->all();
        $this->assertCount(19, $match);
        $this->assertInstanceOf(District::class, $match[0]);
        $this->assertSame(18, $match[0]->DistrictId);
        $this->assertSame('Hålogaland Fotballkrets', $match[0]->DistrictName);
    }

    /**
     * Test get method
     * Successful request
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\TeamsRequests::get()
     */
    public function testGetSuccess(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('teams/get.json'),
        );
        $request = new ClubsRequests($this->validConfig());
        $this->assertSame('Club', $request->entityName);
        $club = $request->get(1);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test get method
     * Successful request
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::sendRequest()
     */
    public function testGetForbidden(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/teams/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeForbiddenResponse(),
        );
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('Request tried `teams/1`, but response returned with code 403 ()');
        $request = new TeamsRequests($this->validConfig());
        $this->assertSame('Team', $request->entityName);
        $club = $request->get(1);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test get method
     * Successful request
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::sendRequest()
     */
    public function testGetNotFound(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeNotFoundResponse(),
        );
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('Request tried `clubs/1`, but response returned with code 404 ()');
        $request = new ClubsRequests($this->validConfig());
        $club = $request->get(1);
        $this->assertInstanceOf(Club::class, $club);
    }

    /**
     * Test get method
     * Successful request
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @throws \Avolle\Fotballdata\Exception\InvalidResponseException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::sendRequest()
     */
    public function testGetNotFoundWithResponseBody(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/stadiums/10814?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeNotFoundResponse('empty.json'),
        );
        $request = new StadiumsRequests($this->validConfig());
        $stadium = $request->get(10814);
        $this->assertInstanceOf(Stadium::class, $stadium);
        $this->assertInstanceOf(ResponseStatus::class, $stadium->ResponseStatus);
        $this->assertSame('No stadium with id 10814 was found.', $stadium->ResponseStatus->Message);
    }

    /**
     * Test constructor method
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\EntityClassNotFoundException
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::convertResponse()
     */
    public function testConstructorResponseNotJson(): void
    {
        Client::clearMockResponses();
        Client::addMockResponse(
            'GET',
            'https://api.fotballdata.no/v1/clubs/1?clubId=1&cid=2&cwd=a-pass&format=json',
            $this->fakeOkResponse('invalid.txt'),
        );
        $this->expectException(InvalidResponseException::class);
        $this->expectExceptionMessage('Response could not be converted from JSON into usable entity');
        $request = new ClubsRequests($this->validConfig());
        $request->get(1);
    }

    /**
     * Test constructor method
     * Invalid config
     *
     * @return void
     * @throws \Avolle\Fotballdata\Exception\InvalidConfigException
     * @uses \Avolle\Fotballdata\Request\BaseRequest::__construct()
     */
    public function testConstructorInvalidConfig(): void
    {
        $config = [];
        $this->expectException(InvalidConfigException::class);
        $this->expectExceptionMessage('You must specify `clubId`, `cid` and `cwd` in config array.');
        new MatchesRequests($config);
    }
}
